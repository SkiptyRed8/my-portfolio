# Amalyn Bonaobra — Personal Portfolio (PHP + MySQL)

**Name:** Bonaobra Amalyn T. · **Section:** BSIT 2 Y2-2 · Midterm Project

A personal portfolio with a PHP backend and MySQL database:

- **Home / About** (`index.php`): welcome message, photo, bio, skills and projects
- **Contact** (`contact.php`): asks for your name first, then shows
  *"Welcome [Name] to my Portfolio!"* and an email + message form saved to the database
- **Admin panel** (`admin/`): login page and a protected dashboard listing every message
  (Name, Email, Message, Date Sent) with a Logout button

## Project structure

```
index.php              Home / About page
contact.php            Two-step contact page
style.css              All styles (organized by section, responsive)
database.sql           Creates portfolio_db and the contact_messages table
includes/
  config.php           Database settings + admin username / password hash
  db.php               PDO connection and helper functions
  header.php           Shared <head> and navigation
  footer.php           Shared footer
admin/
  login.php            Admin login
  dashboard.php        Messages table (login required)
  logout.php           Ends the admin session
images/, imageIcon/    Pictures and icons
```

## Database

Database `portfolio_db`, one table:

| Column    | Type                                 |
|-----------|--------------------------------------|
| id        | INT, PRIMARY KEY, AUTO_INCREMENT     |
| name      | VARCHAR(100)                         |
| email     | VARCHAR(100)                         |
| message   | TEXT                                 |
| date_sent | TIMESTAMP (defaults to current time) |

## Security

- Admin password is stored only as a `password_hash()` bcrypt hash and checked with `password_verify()`.
- All queries use PDO prepared statements, which prevents SQL injection.
- All output is escaped with `htmlspecialchars()`, which prevents XSS.
- Inputs are validated on the server: name format and length, `FILTER_VALIDATE_EMAIL`, message length.
- Forms carry a CSRF token. The admin session ID is regenerated on login, and login locks for 60 seconds after 5 wrong attempts.
- `display_errors` is off, so visitors never see raw PHP errors. Errors go to the server log.

## Run locally (XAMPP)

1. Copy this folder into `C:\xampp\htdocs\my-portfolio`.
2. Start **Apache** and **MySQL** in the XAMPP Control Panel.
3. Open <http://localhost/phpmyadmin>, go to **Import**, and choose `database.sql`.
4. Visit <http://localhost/my-portfolio/>.

The default `includes/config.php` (`root` with an empty password on `localhost`) already matches XAMPP.

## Deploy online (InfinityFree, free PHP + MySQL hosting)

GitHub Pages only serves static files and **cannot run PHP**. Host the site on a PHP host instead.

1. Create a free account at <https://www.infinityfree.com> and add a hosting account with a free subdomain,
   e.g. `amalynportfolio.free.nf`.
2. In the hosting **Control Panel**, open **MySQL Databases** and create a database named `portfolio_db`.
   Note the **MySQL host**, **username**, **database name** (it gets a prefix, like `if0_12345678_portfolio_db`)
   and your **password** (the hosting account password).
3. Open **phpMyAdmin** for that database, go to the **SQL** tab, paste the `CREATE TABLE contact_messages ...`
   statement from `database.sql`, and run it. (Free hosts don't allow `CREATE DATABASE`.)
4. Edit `includes/config.php` and fill in `DB_HOST`, `DB_NAME`, `DB_USER` and `DB_PASS` with the values from step 2.
5. Open **File Manager** (or connect with FileZilla over FTP), go to `htdocs/`, delete the default `index2.html`,
   and upload every file and folder from this project.
6. Open your URL and work through the testing checklist below.

## Admin login (for testing)

- URL: `/admin/login.php`
- Username: `admin`
- Password: `123456`

To change the password, run `php -r "echo password_hash('NEW_PASSWORD', PASSWORD_DEFAULT);"`
and paste the output into `ADMIN_PASSWORD_HASH` in `includes/config.php`.

## Testing checklist

- [x] Home page loads successfully
- [x] Navigation works on all pages
- [x] Contact page asks for name first
- [x] Welcome message displays with user's name
- [x] Contact form appears after welcome message
- [x] Contact form submission saves to database
- [x] Success message displays after form submission
- [x] Admin login page displays
- [x] Admin login works with correct credentials
- [x] Admin dashboard displays all contact messages
- [x] Messages show: Name, Email, Message, Date Sent
- [x] Logout button works on admin dashboard
- [x] Website is responsive (tested at 390px and 1366px wide)
- [x] No PHP errors displayed
