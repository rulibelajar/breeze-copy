import axios from "axios";

// Semua request otomatis dianggap AJAX
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Biar session & CSRF cookie dari Laravel ikut terkirim
axios.defaults.withCredentials = true;

// Ambil CSRF token dari meta tag <head>
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found. Pastikan ada <meta name='csrf-token'> di layout."
    );
}

export default axios;
