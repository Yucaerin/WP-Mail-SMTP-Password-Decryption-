# 🔐 WP Mail SMTP Password Decryption Tool

This script is used to decrypt the encrypted SMTP password stored by the **WP Mail SMTP** plugin in WordPress. The plugin encrypts the SMTP password and stores it in the database. This script utilizes the plugin's encryption key to decrypt that password.

---

## 📁 File Structure

```
project-root/
└── wp-content/
    └── plugins/
        └── wp-mail-smtp/
            └── tools/
                └── decrypt.php   <-- (Place this script here)
```

---

## 🧾 Requirements

- A working WordPress installation with `wp-load.php` accessible.
- **WP Mail SMTP** plugin installed and activated.
- Access to the WordPress file system.
- The encrypted password (`pass`) from the database.

---

## 🧠 How It Works

1. The script includes `wp-load.php` to load WordPress functions and configurations.
2. Retrieves the **secret key** from the WP Mail SMTP plugin using `Crypto::get_secret_key()`.
3. Decodes the base64-encoded encrypted password.
4. Extracts the IV (Initialization Vector) and the ciphertext.
5. Decrypts the password using `openssl_decrypt` with `AES-256-CBC` encryption.

---

## ▶️ How to Use

1. **Get the Encrypted Password:**

   Extract the `pass` field from the WordPress database. It typically looks like (this is example):
  
   ```php
   s:4:"pass";s:112:"y/Kw8JhwASfVkQ/hDRRq5hyT6PJouQeUUa+dPQyKbGSy+koYCmOpwAj7sdhRdvI4yVdOeZ4pP4Kjo5dhrssbnjO7P9EuO2ugffpQf9rdqb9F0LuZ0";
   ```

2. **Edit the Script:**

   Replace the `$encrypted` variable value in `decrypt.php` with the actual encrypted string:

   ```php
   $encrypted = 'YOUR_ENCRYPTED_STRING_HERE';
   ```

3. **Run the Script:**

   Execute the script via CLI:

   ```bash
   php decrypt.php
   ```

   Or access it via browser if your server allows:

   ```
   http://your-wordpress-site/wp-content/plugins/wp-mail-smtp/tools/decrypt.php
   ```

---

## 📌 Example Output

```
Decrypted SMTP Password: your-real-smtp-password
```

---

## ⚠️ Security Notice

- **DO NOT** leave the `decrypt.php` script accessible on the server after use.
- Always remove the script after you're done.
- Only trusted personnel should have access to run this script.

---

## 🧑‍💻 Credits

This tool uses internal methods from the [WP Mail SMTP](https://wordpress.org/plugins/wp-mail-smtp/) plugin to securely decrypt SMTP passwords.
