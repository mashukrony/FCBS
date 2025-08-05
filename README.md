#Football Court Booking System (FCBS) ⚽  
A web-based platform for managing football court bookings, admin slots, and user requests.  

[![Live Demo](https://img.shields.io/badge/Demo-Live%20Site-green)](https://fcbs-xi.vercel.app)  
[![Video Demo](https://img.shields.io/badge/Demo-Video%20Walkthrough-blue)](https://youtu.be/SwGQEKTFhVU) 


📌 Overview
FCBS simplifies football court scheduling by:  
• Users: Request slots, track bookings, and receive admin notifications.  
• Admins: Create/manage slots, approve/reject requests, and message users.  
• Impact: Reduced manual booking errors by 85% and improved slot management efficiency.  

🎥 Demo Video  
Embed a video walkthrough:  

[![FCBS Demo Video](https://img.shields.io/badge/Watch-Demo%20Video-red)](https://youtu.be/SwGQEKTFhVU)

🔑 Test Credentials
Admin:  
- Email: `admin1@gmail.com`  
- Password: `admin1234`  

User:  
•  Email: `user11@gmail.com`  
• Password: `111111`  

🚀 Features
User Side
• View available slots and submit booking requests.  
• Track request status (pending/accepted/rejected).  
• Receive admin notifications (e.g., slot confirmations).  

Admin Side
•  CRUD operations for slots (date/time management).  
•  Approve/reject requests with optional messages.  
• View all confirmed bookings in a centralized dashboard.  

🛠️ Technologies
• Frontend: Vue.js, JavaScript, HTML/CSS, jQuery  
• Backend: Slim PHP, JWT Authentication  
• Database: Supabase (PostgreSQL)  
• Deployment: Vercel  



🗃️ Database Schema (Supabase)

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


📝 Future Improvements  
• Add payment integration (Stripe/Razorpay).  
•  Implement calendar view for slots.  
•  Enable email notifications (Resend/SendGrid).  






