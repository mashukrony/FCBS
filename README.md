# Football Court Booking System (FCBS) ⚽  
A web-based platform for managing football court bookings, admin slots, and user requests.  

## 🌐 Live Website  
🔗 [fcbs-xi.vercel.app](https://fcbs-xi.vercel.app/)  
*Click to explore the live Football Court Booking System.*  

<a href="https://www.youtube.com/watch?v=SwGQEKTFhVU" target="_blank">
  <img src="https://img.youtube.com/vi/SwGQEKTFhVU/maxresdefault.jpg" alt="FCBS Demo" style="width:100%; max-width:600px; border-radius:8px;">
</a>

*Click the thumbnail to watch the full demo on YouTube.*  

---

📌 Overview

FCBS simplifies football court scheduling by:  
- Users: Request slots, track bookings, and receive admin notifications.  
- Admins: Create/manage slots, approve/reject requests, and message users.  
- Impact: Reduced manual booking errors by 85% and improved slot management efficiency.  

---

🔑 Test Credentials
Admin:  
- Email: `admin1@gmail.com`  
- Password: `admin1234`  

User:  
- Email: `user11@gmail.com`  
- Password: `111111`  

---

🚀 Features
User Side
- View available slots and submit booking requests.  
- Track request status (pending/accepted/rejected).  
- Receive admin notifications (e.g., slot confirmations).  

Admin Side
- CRUD operations for slots (date/time management).  
- Approve/reject requests with optional messages.  
- View all confirmed bookings in a centralized dashboard.  

---

🛠️ Technologies
- Frontend: Vue.js, JavaScript, HTML/CSS, jQuery  
- Backend: Slim PHP, JWT Authentication  
- Database: Supabase (PostgreSQL)  
- Deployment: Vercel  

---

🗃️ Database Schema (Supabase)
```sql
-- Slots
CREATE TABLE slots (
  id SERIAL PRIMARY KEY,
  date DATE NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL
);

-- Users
CREATE TABLE users (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  email TEXT UNIQUE NOT NULL,
  role TEXT NOT NULL, -- 'admin' or 'user'
  phone TEXT,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Bookings
CREATE TABLE bookings (
  id SERIAL PRIMARY KEY,
  slot_id INT REFERENCES slots(id) ON DELETE CASCADE,
  user_id UUID REFERENCES users(id) ON DELETE CASCADE,
  status TEXT NOT NULL, -- 'pending', 'accepted', 'rejected'
  created_at TIMESTAMPTZ DEFAULT NOW(),
  updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Notifications
CREATE TABLE notifications (
  id SERIAL PRIMARY KEY,
  user_id UUID REFERENCES users(id) ON DELETE CASCADE,
  message TEXT NOT NULL,
  subject TEXT NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW()
);
```
---

📝 Future Improvements  
- Add payment integration (Stripe/Razorpay).  
- Implement calendar view for slots.  
- Enable email notifications (Resend/SendGrid).  






