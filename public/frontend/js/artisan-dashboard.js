document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".dashboard-tab");
  const sections = {
    products: document.getElementById("productsSection"),
    orders: document.getElementById("ordersSection"),
    messages: document.getElementById("messagesSection"),
    analytics: document.getElementById("analyticsSection")
  };

  function showTab(tabName) {
    Object.values(sections).forEach(sec => {
      sec.classList.add("hidden");
    });

    tabs.forEach(tab => {
      tab.classList.remove("bg-[#F4E7DD]");
    });

    if (sections[tabName]) {
      sections[tabName].classList.remove("hidden");
    }

    document.querySelector(`[data-tab="${tabName}"]`)
      ?.classList.add("bg-[#F4E7DD]");
  }

  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      showTab(tab.dataset.tab);
    });
  });
  showTab("products");
});

/**
 * ==========================================
 * Product Dashboard JavaScript
 * منظم وقابل للصيانة
 * ==========================================
 */

// ==========================================
// 1️⃣ إدارة Modal (فتح/إغلاق)
// ==========================================
// class ProductModal {
//   constructor() {
//     this.modal = document.getElementById('addProductModal');
//     this.openBtn = document.getElementById('addProductBtn');
//     this.closeBtn = document.getElementById('closeModalBtn');
//     this.cancelBtn = document.getElementById('cancelModalBtn');

//     this.init();
//   }

//   init() {
//     if (!this.modal || !this.openBtn) return;

//     // فتح المودال
//     this.openBtn.addEventListener('click', () => this.open());

//     // إغلاق المودال (زر X)
//     if (this.closeBtn) {
//       this.closeBtn.addEventListener('click', () => this.close());
//     }

//     // إغلاق المودال (زر Cancel)
//     if (this.cancelBtn) {
//       this.cancelBtn.addEventListener('click', () => this.close());
//     }

//     // إغلاق عند الضغط خارج المودال
//     this.modal.addEventListener('click', (e) => {
//       if (e.target === this.modal) {
//         this.close();
//       }
//     });
//   }

//   open() {
//     this.modal.classList.remove('hidden');
//     this.modal.classList.add('flex');
//     document.body.classList.add('modal-open');
//   }

//   close() {
//     this.modal.classList.add('hidden');
//     this.modal.classList.remove('flex');
//     document.body.classList.remove('modal-open');
//     this.resetForm();
//   }

//   resetForm() {
//     const form = this.modal.querySelector('form');
//     if (form) form.reset();

//     // إعادة تعيين الأحجام والألوان
//     sizes = [];
//     colors = [];
//     renderSizes();
//     renderColors();

//     // إخفاء حقول التخصيص
//     const customFields = document.getElementById('customizationFields');
//     if (customFields) customFields.classList.add('hidden');

//     const checkbox = document.getElementById('isCustomizable');
//     if (checkbox) checkbox.checked = false;
//   }
// }

// ==========================================
// 2️⃣ إدارة الأحجام والألوان
// ==========================================
let sizes = [];
let colors = [];

class CustomizationManager {
  constructor() {
    this.sizeInput = document.getElementById('sizeInput');
    this.addSizeBtn = document.getElementById('addSizeBtn');
    this.colorNameInput = document.getElementById('colorNameInput');
    this.colorInput = document.getElementById('colorInput');
    this.addColorBtn = document.getElementById('addColorBtn');
    this.isCustomizable = document.getElementById('isCustomizable');
    this.customizationFields = document.getElementById('customizationFields');

    this.init();
  }

  init() {
    // toggle حقول التخصيص
    if (this.isCustomizable) {
      this.isCustomizable.addEventListener('change', () => this.toggleCustomFields());
    }

    // إضافة الأحجام
    if (this.addSizeBtn) {
      this.addSizeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        this.addSize();
      });
    }

    // إضافة الألوان
    if (this.addColorBtn) {
      this.addColorBtn.addEventListener('click', (e) => {
        e.preventDefault();
        this.addColor();
      });
    }

    // مفتاح Enter للأحجام
    if (this.sizeInput) {
      this.sizeInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
          e.preventDefault();
          this.addSize();
        }
      });
    }

    // مفتاح Enter للألوان
    if (this.colorNameInput) {
      this.colorNameInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
          e.preventDefault();
          this.addColor();
        }
      });
    }
  }

  toggleCustomFields() {
    if (this.isCustomizable.checked) {
      this.customizationFields.classList.remove('hidden');
    } else {
      this.customizationFields.classList.add('hidden');
    }
  }

  addSize() {
    if (!this.sizeInput) return;

    const value = this.sizeInput.value.trim();

    if (!value) {
      alert('الرجاء إدخال حجم');
      return;
    }

    if (sizes.includes(value)) {
      alert('هذا الحجم موجود بالفعل');
      return;
    }

    sizes.push(value);
    renderSizes();
    this.sizeInput.value = '';
    this.sizeInput.focus();
  }

  addColor() {
    if (!this.colorInput || !this.colorNameInput) return;

    const colorCode = this.colorInput.value;
    const colorName = this.colorNameInput.value.trim();

    if (!colorName) {
      alert('الرجاء إدخال اسم اللون');
      return;
    }

    if (colors.find(c => c.code === colorCode)) {
      alert('هذا اللون موجود بالفعل');
      return;
    }

    colors.push({
      name: colorName,
      code: colorCode
    });

    renderColors();
    this.colorNameInput.value = '';
    this.colorNameInput.focus();
  }
}

// ==========================================
// 3️⃣ دوال عرض الأحجام والألوان
// ==========================================

function renderSizes() {
  const list = document.getElementById('sizesList');
  const hidden = document.getElementById('sizesHidden');

  if (!list) return;

  list.innerHTML = sizes.map((size, i) => `
        <span class="bg-[#F4E7DD] text-[#835837] px-3 py-1 rounded-lg flex items-center gap-2">
            ${size}
            <button type="button" class="text-red-500 hover:text-red-700 font-bold" onclick="removeSize(${i})">
                ×
            </button>
        </span>
    `).join('');

  if (hidden) {
    hidden.value = JSON.stringify(sizes);
  }
}

function renderColors() {
  const list = document.getElementById('colorsList');
  const hidden = document.getElementById('colorsHidden');

  if (!list) return;

  list.innerHTML = colors.map((color, i) => `
        <span class="px-3 py-1 rounded-lg flex items-center gap-2 text-white font-semibold" 
              style="background-color: ${color.code}; border: 2px solid ${color.code};">
            ${color.name}
            <button type="button" class="text-white opacity-80 hover:opacity-100 font-bold" 
                    onclick="removeColor(${i})">
                ×
            </button>
        </span>
    `).join('');

  if (hidden) {
    hidden.value = JSON.stringify(colors.map(c => c.code));
  }
}

function removeSize(index) {
  sizes.splice(index, 1);
  renderSizes();
}

function removeColor(index) {
  colors.splice(index, 1);
  renderColors();
}

// ==========================================
// 4️⃣ إدارة المنتجات (بحث، تعديل، حذف)
// ==========================================
class ProductManager {
  constructor() {
    this.searchInput = document.getElementById('searchProduct');
    this.productsContainer = document.getElementById('productsContainer');

    this.init();
  }

  init() {
    // البحث عن المنتجات
    if (this.searchInput) {
      this.searchInput.addEventListener('input', (e) => this.searchProducts(e.target.value));
    }

    // تعديل المنتجات
    this.attachEditListeners();

    // حذف المنتجات
    this.attachDeleteListeners();
  }

  searchProducts(searchTerm) {
    const term = searchTerm.toLowerCase();
    const products = document.querySelectorAll('.product-card');

    products.forEach(product => {
      const title = product.querySelector('h3')?.innerText?.toLowerCase() || '';
      const description = product.querySelector('p')?.innerText?.toLowerCase() || '';

      if (title.includes(term) || description.includes(term)) {
        product.style.display = '';
      } else {
        product.style.display = 'none';
      }
    });
  }

  attachEditListeners() {
    document.querySelectorAll('.edit-product').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const productCard = e.target.closest('.product-card');
        const productId = productCard?.dataset.productId;
        const productTitle = productCard?.querySelector('h3')?.innerText;

        // يمكن فتح مودال تعديل هنا
        console.log('تعديل المنتج:', { id: productId, title: productTitle });
        alert(`تعديل المنتج: ${productTitle}`);
      });
    });
  }

  attachDeleteListeners() {
    document.querySelectorAll('.delete-product').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const productCard = e.target.closest('.product-card');
        const productTitle = productCard?.querySelector('h3')?.innerText;

        if (confirm(`هل أنت متأكد من حذف المنتج: "${productTitle}"?`)) {
          // إضافة تأثير disappear
          productCard.style.opacity = '0';
          productCard.style.transform = 'scale(0.95)';
          productCard.style.transition = 'all 0.3s ease';

          setTimeout(() => {
            productCard.remove();

            // تحقق إذا كانت الحاوية فارغة
            const remainingProducts = document.querySelectorAll('.product-card');
            if (remainingProducts.length === 0) {
              location.reload(); // أو عرض رسالة "لا توجد منتجات"
            }
          }, 300);
        }
      });
    });
  }
}

// ==========================================
// 5️⃣ إدارة Tab Switching
// ==========================================
class TabManager {
  constructor() {
    this.tabs = document.querySelectorAll('.dashboard-tab');
    this.sections = {
      products: document.getElementById('productsSection'),
      orders: document.getElementById('ordersSection'),
      messages: document.getElementById('messagesSection'),
      analytics: document.getElementById('analyticsSection')
    };

    this.init();
  }

  init() {
    this.tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const tabName = tab.dataset.tab;
        if (tabName) {
          this.switchTab(tabName);
        }
      });
    });
  }

  switchTab(tabName) {
    // إخفاء جميع الأقسام
    Object.values(this.sections).forEach(section => {
      if (section) {
        section.classList.add('hidden');
      }
    });

    // عرض القسم المختار
    if (this.sections[tabName]) {
      this.sections[tabName].classList.remove('hidden');
    }

    // تحديث التبويب النشط
    this.tabs.forEach(tab => {
      if (tab.dataset.tab === tabName) {
        tab.classList.add('active-tab');
      } else {
        tab.classList.remove('active-tab');
      }
    });
  }
}

// ==========================================
// 6️⃣ تهيئة التطبيق
// ==========================================
document.addEventListener('DOMContentLoaded', function () {
  console.log('✅ Dashboard JavaScript Initialized');

  // تهيئة المودال
  new ProductModal();

  // تهيئة إدارة التخصيص
  new CustomizationManager();

  // تهيئة إدارة المنتجات
  new ProductManager();

  // تهيئة إدارة التبويبات
  new TabManager();

  // تهيئة حقول أخرى حسب الحاجة
  initializeOtherFeatures();
});

// ==========================================
// 7️⃣ دوال مساعدة أخرى
// ==========================================
function initializeOtherFeatures() {
  // Animation للـ progress bar
  const visitsProgress = document.getElementById('visitsProgress');
  if (visitsProgress) {
    setTimeout(() => {
      visitsProgress.style.width = '84.7%';
    }, 100);
  }

  // إدارة الرسائل (Mark as read)
  initializeMessages();

  // إدارة Edit Profile
  initializeEditProfile();
}

function initializeMessages() {
  const markAllReadBtn = document.getElementById('markAllRead');
  if (markAllReadBtn) {
    markAllReadBtn.addEventListener('click', () => {
      document.querySelectorAll('.mark-read:not([disabled])').forEach(btn => {
        btn.click();
      });
    });
  }

  // Mark individual messages
  document.querySelectorAll('.mark-read').forEach(btn => {
    btn.addEventListener('click', function () {
      if (!this.disabled) {
        const card = this.closest('.message-card');
        card.classList.remove('bg-[#FFF8F0]');
        card.classList.add('bg-white');
        card.style.borderLeft = 'none';

        const badge = card.querySelector('.bg-red-100');
        if (badge) badge.remove();

        this.disabled = true;
        this.innerHTML = '<i class="fa-regular fa-circle-check mr-1"></i>Read';
      }
    });
  });
}

function initializeEditProfile() {
  const editBtn = document.getElementById('editProfileBtn');
  const editModal = document.getElementById('editProfileModal');

  if (editBtn && editModal) {
    editBtn.addEventListener('click', () => {
      editModal.classList.remove('hidden');
      editModal.classList.add('flex');
      document.body.classList.add('modal-open');
    });

    // إغلاق المودال
    const closeBtn = editModal.querySelector('#closeModalBtn');
    const cancelBtn = editModal.querySelector('#cancelModalBtn');

    if (closeBtn) {
      closeBtn.addEventListener('click', () => {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
        document.body.classList.remove('modal-open');
      });
    }

    if (cancelBtn) {
      cancelBtn.addEventListener('click', () => {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
        document.body.classList.remove('modal-open');
      });
    }
  }
}

// ==========================================
// 8️⃣ Debug Mode (اختياري)
// ==========================================
const DEBUG = false;

function log(message, data = null) {
  if (DEBUG) {
    console.log(`[DEBUG] ${message}`, data || '');
  }
}