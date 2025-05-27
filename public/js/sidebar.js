// Toggle sidebar on desktop
const toggleSidebar = () => {
    document.querySelector('.sidebar').classList.toggle('collapsed');
    document.querySelector('.main-content').classList.toggle('expanded');
  };
  
  // Toggle sidebar on mobile
  const toggleMobileSidebar = () => {
    document.querySelector('.sidebar').classList.toggle('show');
    document.querySelector('.overlay').classList.toggle('show');
  };
  
  // Close sidebar when clicking on overlay
  document.querySelector('.overlay').addEventListener('click', toggleMobileSidebar);
  
  // Close sidebar when clicking on a nav link (mobile)
  document.querySelectorAll('.sidebar .nav-link').forEach(link => {
    link.addEventListener('click', function() {
      if (window.innerWidth < 992) {
        toggleMobileSidebar();
      }
    });
  });
  
  // Add desktop toggle button if needed
  const addDesktopToggle = () => {
    if (window.innerWidth >= 992) {
      const toggleBtn = document.createElement('button');
      // toggleBtn.className = 'btn btn-outline-primary d-lg-none toggle-mobile-sidebar';
      toggleBtn.className = 'btn btn-outline-primary position-fixed toggle-sidebar';
      toggleBtn.style.cssText = 'z-index: 1050; left: 15px; top: 10px;';
      toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
      toggleBtn.addEventListener('click', toggleSidebar);
      document.body.appendChild(toggleBtn);
    }
  };
  
  // Initialize
  window.addEventListener('DOMContentLoaded', addDesktopToggle);
  window.addEventListener('resize', addDesktopToggle);