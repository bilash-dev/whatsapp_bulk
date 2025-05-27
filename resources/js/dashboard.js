
document.getElementById('openWhatsApp').addEventListener('click', async function() {
    const statusMessage = document.getElementById('statusMessage');
    statusMessage.textContent = 'Opening WhatsApp...';
    statusMessage.className = '';

    try {
        const response = await fetch('/open-whatsapp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Failed to open WhatsApp');
        }

        statusMessage.textContent = data.message;
        statusMessage.className = 'success';
    } catch (error) {
        statusMessage.textContent = error.message;
        statusMessage.className = 'error';
        console.error('Error:', error);
    }
});


// <a href="#" onclick="openWhatsApp()">Chat on WhatsApp</a>
// function openWhatsApp() {
//   const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
//   const message = encodeURIComponent('Hello');
//   const phone = '123456789';
  
//   if (isMobile) {
//     window.location.href = `whatsapp://send?phone=${phone}&text=${message}`;
//     setTimeout(() => {
//       window.location.href = `https://wa.me/${phone}?text=${message}`;
//     }, 1000);
//   } else {
//     window.open(`https://web.whatsapp.com/send?phone=${phone}&text=${message}`, '_blank');
//   }
// }

