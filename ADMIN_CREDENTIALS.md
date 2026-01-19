# Admin Panel Access Credentials

## Admin Login Details

**URL:** `http://localhost:8000/login` or `http://localhost:8000/admin` (after login)

**Email:** `admin@amanivehiclesounds.co.ke`  
**Password:** `admin123`

---

## Additional Admin Accounts

The following admin accounts are also available (from AdminSeeder):

1. **Super Admin**
   - Email: `admin@amanivehiclesounds.co.ke`
   - Password: `admin123`
   - Position: Super Administrator

2. **John Admin**
   - Email: `john.admin@example.com`
   - Password: `admin123`
   - Position: Administrator

3. **Sarah Manager**
   - Email: `sarah.manager@example.com`
   - Password: `admin123`
   - Position: Content Manager

4. **Mike Editor**
   - Email: `mike.editor@example.com`
   - Password: `admin123`
   - Position: Content Editor

5. **Lisa Support**
   - Email: `lisa.support@example.com`
   - Password: `admin123`
   - Position: Support Staff

---

## Regular User Accounts (for testing)

1. **John Doe**
   - Email: `john.doe@example.com`
   - Password: `password123`

2. **Jane Smith**
   - Email: `jane.smith@example.com`
   - Password: `password123`

---

## Notes

- Admin users have `type = 1` in the users table
- Regular users have `type = 0` in the users table
- After login, admin users are redirected to `/admin`
- Regular users are redirected to `/dashboard`
- The admin panel is accessible at `/admin` after authentication

---

## Security Recommendation

**⚠️ IMPORTANT:** Change these default passwords immediately in production!
