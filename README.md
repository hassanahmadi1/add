
# ربات تبچی تلگرام با PHP 🤖💰

ربات هوشمند مدیریت تبلیغات و عضویت اجباری در کانال‌های تلگرام (تبلیغاتچی)

## ✨ ویژگی‌های اصلی
- **عضویت اجباری**: کاربران برای استفاده از ربات باید در کانال‌های指定 شده عضو شوند
- **مدیریت چند کاناله**: قابلیت تعریف چندین کانال برای بررسی عضویت
- **سیستم امتیازدهی**: به ازای هر عضوگیری، امتیاز به کاربر تعلق می‌گیرد
- **تبلیغات هدفمند**: ارسال پیام‌های تبلیغاتی به کاربران فعال
- **آمار و گزارش‌گیری**: نمایش آمار دقیق از تعداد اعضا، کلیک‌ها و تعاملات

## 🛠️ تکنولوژی‌های استفاده شده
<div align="right">

| تکنولوژی | نسخه | کاربرد |
|:--------:|:----:|:------:|
| <img src="https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white" alt="PHP" /> | 7.4+ | هسته اصلی ربات |
| <img src="https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white" alt="MySQL" /> | 5.7+ | پایگاه داده |
| <img src="https://img.shields.io/badge/Telegram%20Bot%20API-2CA5E0?style=flat&logo=telegram&logoColor=white" alt="Telegram Bot API" /> | - | ارتباط با تلگرام |

</div>

## 📁 ساختار پروژه
```
add/
├── 📂 vendor/                 # کتابخانه‌های نصب شده با Composer
├── 📄 index.php               # فایل اصلی و Webhook handler
├── 📄 .gitattributes          # تنظیمات گیت
└── 📄 composer.json           # وابستگی‌های پروژه (پیشنهادی)
```

## 🚀 راه‌اندازی سریع

### پیش‌نیازها
- PHP 7.4 یا بالاتر
- MySQL 5.7 یا بالاتر
- Composer (مدیریت وابستگی‌ها)
- هاست یا سرور با SSL (HTTPS اجباری)

### مراحل نصب

1. **دریافت پروژه**
   ```bash
   git clone https://github.com/hassanahmadi1/add.git
   cd add
   ```

2. **نصب وابستگی‌ها**
   ```bash
   composer install
   ```

3. **تنظیم پایگاه داده**
   ```sql
   CREATE DATABASE tabchi_bot;
   -- فایل SQL پروژه را import کنید
   ```

4. **پیکربندی ربات**
   فایل `config.php` را ایجاد کرده و مقادیر زیر را تنظیم کنید:
   ```php
   <?php
   define('BOT_TOKEN', 'توکن_ربات_شما');
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tabchi_bot');
   define('DB_USER', 'username');
   define('DB_PASS', 'password');
   
   $force_channels = [
       '@channel1',
       '@channel2',
       '@channel3'
   ];
   ```

5. **تنظیم Webhook**
   ```bash
   https://api.telegram.org/bot<BOT_TOKEN>/setWebhook?url=https://yourdomain.com/index.php
   ```

## 💡 قابلیت‌های ویژه

### 👥 برای کاربران
- ✅ **بررسی خودکار عضویت** قبل از هر اقدام
- ✅ **دریافت لینک دعوت** اختصاصی
- ✅ **مشاهده امتیازات** و موجودی
- ✅ **درخواست برداشت** وجه

### 👨‍💻 برای مدیران
- 🔧 **پنل مدیریتی** ساده
- 📊 **گزارشات لحظه‌ای** از آمار
- 📢 **ارسال همگانی** پیام
- 🎯 **تعیین پلن‌های** تبلیغاتی

## 📞 ارتباط با ما
برای ارتباط با توسعه‌دهنده و ارائه پیشنهادات:

<div align="center">

| روش ارتباطی | آدرس |
|:------------:|:----:|
| ✉️ **ایمیل** | [HassanAhmadi142@gmail.com](mailto:HassanAhmadi142@gmail.com) |
| 📱 **تلگرام** | [@Ahmaditel](https://t.me/Ahmaditel) |
| 📲 **روبیکا** | [@hassanahmadiz](https://rubika.ir/hassanahmadiz) |

</div>

## 🤝 مشارکت در توسعه
اگر تجربه‌ای در PHP و ربات‌های تلگرام دارید:
1. مخزن را Fork کنید
2. Branch جدید بسازید (`git checkout -b feature/AmazingFeature`)
3. تغییرات را Commit کنید (`git commit -m 'Add some AmazingFeature'`)
4. Push کنید (`git push origin feature/AmazingFeature`)
5. Pull Request ارسال کنید

## 📊 آمار پروژه
![GitHub stars](https://img.shields.io/github/stars/hassanahmadi1/add?style=social)
![GitHub forks](https://img.shields.io/github/forks/hassanahmadi1/add?style=social)
![GitHub watchers](https://img.shields.io/github/watchers/hassanahmadi1/add?style=social)
![GitHub last commit](https://img.shields.io/github/last-commit/hassanahmadi1/add)

## 🔐 امنیت
- **اعتبارسنجی درخواست‌ها** از سمت تلگرام
- **جلوگیری از حملات** SQL Injection
- **محافظت** در برابر Cross-site Scripting (XSS)
- **رمزنگاری** اطلاعات حساس

## 📜 لایسنس
این پروژه تحت لیسانس **MIT** منتشر شده است. استفاده تجاری و شخصی آزاد است.

## 🙏 سپاسگزاری
تشکر ویژه از جامعه توسعه‌دهندگان PHP و تیم تلگرام برای API عالی‌شان.

---
<div align="center">
  <sub>ساخته شده با ❤️ توسط حسن احمدی</sub>
  <br>
  <sub>⭐️ اگر این ربات برای شما مفید است، با یک ستاره از ما حمایت کنید</sub>
  <br>
  <sub>✨ پیشنهادات و انتقادات شما مایه پیشرفت ماست</sub>
</div>
