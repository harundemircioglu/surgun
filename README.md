## 🌱 Sürgün – Botanik Bahçesi Yönetim Sistemi

**Sürgün**, bir botanik bahçesi için örnek olarak Laravel altyapısıyla geliştirilen, modüler ve genişletilebilir yapıya sahip bir veri yönetim uygulamasıdır. Bu proje, bitki materyallerinin, kökenlerinin, konumlarının ve durumlarının kayıt altına alınmasını kolaylaştırmayı amaçlar.

---

### 🚀 Özellikler

* 👤 Kullanıcı kayıt ve giriş sistemi
* 🔐 İki adımlı doğrulama (2FA) ve geçici şifre ile erişim
* 📊 Dashboard üzerinde hızlı veri görünümü
* 📅 Excel üzerinden **içe aktarma** (arka planda job ile)
* 📄 Excel üzerinden **dışına aktarma** (arka planda job ile)
* 📧 Başarılı / hatalı içe aktarma sonrası mail bildirimi
* 📊 Grafiksel analizler (pasta grafik)
* 📦 Role ve permission tabanlı yetkilendirme sistemi

---

### 🗃️ Ekran Görüntüleri

#### 🔑 Giriş Ekranı

![Login](assets/screenshots/login.png)

#### 📧 İki Adımlı Doğrulama

![2FA](assets/screenshots/two_step_verification.png)

#### 🧲 Dashboard (Hızlı Bilgiler)

![Dashboard](assets/screenshots/dashboard.png)

#### 📅 Excel İçe Aktarma Ekranı

![Import](assets/screenshots/import.png)

#### 📄 Excel Dışa Aktarma Ekranı

![Export](assets/screenshots/export.png)

#### 📧 İçe Aktarma Sonrası Başarılı Mail

![Import Success Email](assets/screenshots/import_email_succes.png)

#### ❌ Hatalı İçerik Maili

![Import Error Email](assets/screenshots/import_email_fail.png)

---

### 🛠️ Kullanılan Teknolojiler

* **Laravel**
* **Tailwind CSS**
* **Flowbite**
* **MySQL**
* **Laravel Excel**
* **Spatie Permission**
* **Job Queue (Queueable Jobs)**
* **Mail Notification System**

---

### 🧠 Veri Tabanı

Bu proje, gerçek bir botanik bahçesinden sağlanan tablo yapıları referans alınarak geliştirilmiştir. Veri yapısı, **aksesyon defteri**, **bitki materyalleri**, **kökenler**, **durumlar** ve **lokasyonlar** gibi tabloları içerir.

---

### 📁 Kurulum

```bash
git clone https://github.com/kullaniciadi/surgun.git
cd surgun
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

### 🧪 Testler & Demo

Özellikler test edilirken veri içe ve dışa aktarma süreçleri Laravel Jobs kullanılarak arka planda yürütülmüştür. Kullanıcı bilgilendirmeleri mail ile sağlanır.

---

### 🔗 Bağlantılar

* [📂 GitHub Repository](https://github.com/harundemircioglu/surgun)
* [📖 Laravel Excel](https://laravel-excel.com/)
* [📻 Flowbite Docs](https://flowbite.com/docs/)
* [🛡️ Spatie Permission](https://spatie.be/docs/laravel-permission)
