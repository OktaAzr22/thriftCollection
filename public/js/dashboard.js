// Sidebar
function toggleSidebar() {
  const body = document.body;
  const icon = document.getElementById("collapseIcon");
  
  body.classList.toggle("sidebar-collapsed");
  
  if (body.classList.contains("sidebar-collapsed")) {
    icon.classList.remove("fa-angle-double-left");
    icon.classList.add("fa-angle-double-right");
  } else {
    icon.classList.remove("fa-angle-double-right");
    icon.classList.add("fa-angle-double-left");
  }
}

// Form Toggle
function toggleForm() {
  const formContent = document.getElementById("formContent");
  const icon = document.getElementById("toggleIcon");

  if (formContent.style.height === "0px") {
    formContent.style.height = formContent.scrollHeight + "px";
    icon.classList.remove("fa-chevron-down");
    icon.classList.add("fa-chevron-up");
    document.getElementById("toggleFormBtn").setAttribute("aria-expanded", "true");
  } else {
    formContent.style.height = "0px";
    icon.classList.remove("fa-chevron-up");
    icon.classList.add("fa-chevron-down");
    document.getElementById("toggleFormBtn").setAttribute("aria-expanded", "false");
  }
}

// Notifikasi
function toggleNotif() {
  const notif = document.getElementById("notifCard");
  if (notif.classList.contains("opacity-0")) {
    notif.classList.remove("opacity-0", "scale-95", "pointer-events-none");
    notif.classList.add("opacity-100", "scale-100");
  } else {
    notif.classList.remove("opacity-100", "scale-100");
    notif.classList.add("opacity-0", "scale-95", "pointer-events-none");
  }
}

// Klik di luar untuk menutup notifikasi
document.addEventListener('click', function (e) {
  const notif = document.getElementById("notifCard");
  const bell = e.target.closest('button');
  if (!e.target.closest('#notifCard') && !bell) {
    notif.classList.remove("opacity-100", "scale-100");
    notif.classList.add("opacity-0", "scale-95", "pointer-events-none");
  }
});

// Modal
function openModal() {
  const modal = document.getElementById("modalTambah");
  modal.classList.remove("opacity-0", "pointer-events-none");
  modal.firstElementChild.classList.remove("scale-95");
  modal.firstElementChild.classList.add("scale-100");
}

function closeModal() {
  const modal = document.getElementById("modalTambah");
  modal.classList.add("opacity-0", "pointer-events-none");
  modal.firstElementChild.classList.remove("scale-100");
  modal.firstElementChild.classList.add("scale-95");
}

// Tutup modal jika klik di luar konten
document.addEventListener("click", function (e) {
  const modal = document.getElementById("modalTambah");
  if (e.target === modal) closeModal();
});

// Drawer
function openDrawer() {
  const drawer = document.getElementById("drawer");
  drawer.classList.remove("opacity-0", "pointer-events-none");
  drawer.firstElementChild.classList.remove("translate-x-full");
  drawer.firstElementChild.classList.add("translate-x-0");
}

function closeDrawer() {
  const drawer = document.getElementById("drawer");
  drawer.classList.add("opacity-0", "pointer-events-none");
  drawer.firstElementChild.classList.add("translate-x-full");
  drawer.firstElementChild.classList.remove("translate-x-0");
}

// Tutup drawer jika klik luar
document.addEventListener("click", function (e) {
  const drawer = document.getElementById("drawer");
  if (e.target === drawer) closeDrawer();
});

// Action View Table
const optionsToggle = document.getElementById("optionsToggle");
const optionsMenu = document.getElementById("optionsMenu");
const actionBtn = document.getElementById("actionBtn");
const actionIcon = document.getElementById("actionIcon");

let currentAction = "view";
let userId = null;

optionsToggle.addEventListener("click", () => {
  optionsMenu.classList.toggle("hidden");
});

document.addEventListener("click", (e) => {
  if (!optionsToggle.contains(e.target) && !optionsMenu.contains(e.target)) {
    optionsMenu.classList.add("hidden");
  }
});

function setAction(type, id) {
  userId = id;
  if (type === "edit") {
    currentAction = "edit";
    actionIcon.className = "fas fa-edit text-yellow-500";
  } else if (type === "delete") {
    currentAction = "delete";
    actionIcon.className = "fas fa-trash text-red-500";
  } else {
    currentAction = "view";
    actionIcon.className = "fas fa-eye text-blue-600";
  }
  optionsMenu.classList.add("hidden");
}

function goToAction(id) {
  if (currentAction === "delete") {
    const confirmDelete = confirm("Yakin ingin menghapus?");
    if (confirmDelete) {
      // Kirim request delete ke server
      fetch(`/users/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        if (response.ok) {
          window.location.reload();
        }
      });
    }
  } else if (currentAction === "edit") {
    window.location.href = `/users/${id}/edit`;
  } else {
    window.location.href = `/users/${id}`;
  }
}