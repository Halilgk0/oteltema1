# 🌿 Luxury Hotel — Yağmur Ormanı Temalı Otel Sitesi

Laravel ile yazılmış bir otel tanıtım ve rezervasyon sitesi. Tasarım, sisli bir yağmur ormanında tutulmuş eski bir **keşif günlüğü** fikrine dayanıyor: kâğıt dokusu, daktilo yazıları, damgalar, bantlanmış fotoğraflar, sarkan sarmaşıklar ve hareketli sis katmanları.

**Canlı demo:** https://oteltema1.vercel.app

> Sitedeki tüm oda, kullanıcı ve rezervasyon verileri örnek (sahte) verilerdir.

---

## Özellikler

**Ziyaretçiler için**
- Oda tipleri, oda detayları, etkinlikler ve iletişim sayfaları
- Ana sayfada kaydırmalı oda vitrini (Swiper)
- Telefona uyumlu tasarım ve açılır mobil menü

**Üyeler için**
- Kayıt olma, giriş yapma ("beni hatırla" seçeneği ile)
- Rezervasyon: takvimden tarih seçimi (Flatpickr), kişi sayısı seçici, form doğrulama ve gece sayısına göre fiyat hesabı
- Profil sayfası, "Rezervasyonlarım" listesi ve yaklaşan rezervasyonları iptal etme
- Profilden şifre değiştirme; şifre değişince diğer cihazlardaki oturumlar kapanır

**Yönetim paneli**
- Genel bakış: oda, rezervasyon ve bekleyen rezervasyon sayıları
- Oda tipi ve oda ekleme, düzenleme, silme (görsel ve olanak seçimiyle)
- Tüm rezervasyonların listesi

**Güvenlik**
- Yönetim paneline yalnızca admin hesabı erişebilir. Diğer herkes `/admin` adreslerinde 404 görür, yani panelin varlığı bile anlaşılmaz.
- Aynı e-posta için 5 hatalı girişten sonra 1 dakikalık kilit, ayrıca giriş, kayıt, rezervasyon ve şifre işlemlerinde istek sınırı
- Kullanıcılar yalnızca kendi rezervasyonlarını görebilir ve iptal edebilir
- Formlardan admin yetkisi verilemez (`is_admin` toplu atamaya kapalı)
- Tıklama tuzağı (clickjacking) ve MIME sniffing'e karşı güvenlik başlıkları, CSRF koruması

## Teknolojiler

| Katman | Kullanılan |
|---|---|
| Sunucu | PHP 8.2+ (8.4 ile test edildi), Laravel 9 |
| Veritabanı | MySQL (yerel), SQLite (Vercel demosu) |
| Arayüz | Blade, Tailwind CSS (CDN), Alpine.js |
| Bileşenler | Swiper, Flatpickr, Font Awesome |
| Yayın | Vercel + [vercel-php](https://github.com/vercel-community/php) runtime |

## Yerel Kurulum

Gerekenler: PHP 8.2+, Composer ve MySQL (WampServer, XAMPP vb.).

```bash
git clone https://github.com/Halilgk0/oteltema1.git
cd oteltema1
composer install

cp .env.example .env        # Windows: copy .env.example .env
php artisan key:generate
```

MySQL'de `oteltema` adında boş bir veritabanı oluşturun. Farklı bir ad veya şifre kullanıyorsanız `.env` içindeki `DB_*` satırlarını güncelleyin. Ardından:

```bash
php artisan migrate --seed   # tabloları kurar ve örnek verileri ekler
php artisan storage:link     # yönetim panelinden yüklenen görseller için
php artisan serve
```

Site http://127.0.0.1:8000 adresinde açılır. Aynı ağdaki bir telefondan denemek için bilgisayarın yerel IP'sini verin:

```bash
php artisan serve --host=192.168.1.105 --port=8000
```

### Hesaplar

| Hesap | E-posta | Şifre |
|---|---|---|
| Yönetici | `admin@admin.com` | `.env` içindeki `ADMIN_PASSWORD`; boşsa `admin123` |
| Örnek misafirler | `elif.yildiz@example.com` vb. | Rastgele. Denemek için yeni bir hesap açın. |

Yönetim paneline ayrı bir giriş sayfası yoktur. Admin hesabıyla normal **Giriş Yap** sayfasından girildiğinde doğrudan panele yönlendirilir. Panele menüdeki **Yönetim Paneli** bağlantısından da ulaşılabilir.

> `admin123` yalnızca yerel geliştirme içindir ve bu repoda herkes tarafından görülebilir. Herkese açık bir sunucuda mutlaka `ADMIN_PASSWORD` tanımlayın.

## Vercel'de Yayın

Proje Vercel'e hazır olarak gelir. GitHub reposunu Vercel'e bağlamak yeterlidir; `main` dalına yapılan her push otomatik olarak yayına alınır.

**Nasıl çalışır?**
- `vercel.json` tüm istekleri `api/index.php` dosyasına yönlendirir. Bu dosya Laravel'i PHP 8.4 runtime'ı ile çalıştırır.
- Vercel'de yalnızca geçici klasör (`/tmp`) yazılabilir. `api/index.php`, önbellekleri, derlenmiş görünümleri ve veritabanını oraya yönlendirir.
- Demo veritabanı geçici bir SQLite dosyasıdır. Sunucunun ilk isteğinde tablolar kurulur ve örnek veriler eklenir (`DB_AUTO_SETUP`).

**Vercel'de tanımlanması gereken ortam değişkenleri**

| Değişken | Açıklama |
|---|---|
| `APP_KEY` | `php artisan key:generate --show` ile üretilen anahtar |
| `ADMIN_PASSWORD` | Canlı sitedeki admin şifresi |
| `APP_NAME` | Sitede görünen otel adı, örn. `Luxury Hotel` |

Geri kalan ayarların varsayılanları `api/index.php` içindedir ve Vercel'de aynı adla bir değişken tanımlanarak değiştirilebilir.

**Demo sınırlamaları**
- Veritabanı kalıcı değildir. Site bir süre ziyaret edilmezse veya Vercel yeni bir sunucu başlatırsa yeni kayıtlar, rezervasyonlar ve panelde yapılan değişiklikler silinir ve örnek veriler geri gelir. Admin şifresini değiştirmek için profil sayfası yerine Vercel'deki `ADMIN_PASSWORD` değişkenini kullanın.
- Yönetim panelinden yüklenen oda görselleri Vercel'de saklanamaz ve görüntülenmez. Örnek odaların görselleri dış bağlantı olduğu için sorunsuz görünür. Görsel yükleme için Vercel Blob veya S3 gibi bir depolama servisi gerekir.

**Kalıcı veritabanına geçmek için:** Ücretsiz bir MySQL veya PostgreSQL veritabanı açın (örneğin Vercel panelinden Neon Postgres). Ardından Vercel'de `DB_CONNECTION` (`mysql` veya `pgsql`) ve `DATABASE_URL` değişkenlerini tanımlayın. İlk istekte tablolar otomatik kurulur; veritabanı boşsa örnek veriler de eklenir.

## Proje Yapısı

```
api/index.php                 Vercel giriş noktası
app/Http/Controllers/         Site, üyelik, rezervasyon ve yönetim controller'ları
app/Http/Middleware/          AdminMiddleware (404 ile gizleme), SecurityHeaders
app/Providers/                İstek sınırları ve demo veritabanı kurulumu
database/migrations, seeders  Tablolar ve örnek veriler
resources/views/              Blade şablonları
  layouts/app.blade.php         Ana sayfa düzeni, menü ve alt bilgi
  partials/                     Tema stilleri ve dekoratif parçalar (sarmaşık, sis, ...)
  admin/                        Yönetim paneli
routes/web.php                Tüm adresler
vercel.json                   Vercel ayarları
```

## Yayına Almadan Önce

Kendi sunucunuzda veya alan adınızda yayınlayacaksanız:

- `.env` içinde `APP_ENV=production` ve `APP_DEBUG=false` olmalı.
- Site HTTPS üzerinden sunulmalı ve `SESSION_SECURE_COOKIE=true` yapılmalı.
- Veritabanı için şifresiz `root` yerine ayrı, şifreli bir kullanıcı kullanılmalı.
- Sunucunun kök klasörü `public/` olmalı. `.env` dosyası asla repoya eklenmemeli; `.gitignore` bunu zaten engelliyor.
