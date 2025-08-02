// Auth functions
async function login(email, password) {
  try {
    const { data, error } = await supabase.auth.signInWithPassword({
      email,
      password
    });

    if (error) throw error;

    // 🔒 Save token & user info
    localStorage.setItem('supabase_token', data.session.access_token);
    localStorage.setItem('supabase_user_id', data.user.id);


    // Get user role
    const { data: userData } = await supabase
      .from('users')
      .select('role')
      .eq('id', data.user.id)
      .single();

    // Redirect
    window.location.href = userData.role === 'admin' 
      ? 'admin/slots.html' 
      : 'user/dashboard.html';

  } catch (error) {
    alert(`Login failed: ${error.message}`);
    console.error(error);
  }
}

async function signup(email, password) {
  try {
    const { data, error } = await supabase.auth.signUp({
      email,
      password,
      options: {
        emailRedirectTo: window.location.origin + '/auth-callback.html'
      }
    });

    if (error) throw error;

    // Add to users table
    const { error: dbError } = await supabase
      .from('users')
      .insert([{ 
        id: data.user.id, 
        email: data.user.email,
        role: 'user'
      }]);

    if (dbError) throw dbError;

    alert('Signup successful!');
    document.getElementById('signup-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';

  } catch (error) {
    alert(`Signup failed: ${error.message}`);
    console.error(error);
  }
}

// Make functions globally available
window.login = login;
window.signup = signup;