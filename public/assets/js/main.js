function showToast(message) {
  const toastEl   = document.getElementById("liveToast");
  const toastBody = document.getElementById("toastMessage");

  if (typeof message === 'object' && message !== null) {
    message = Object.values(message).join('\n');
  }

  toastBody.textContent = message;

  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}
