// Delete Account In Settings
const deleteButton = document.querySelector(".delete-account");
const deleteButtonReal = document.querySelector(".delete-account-real");
const cancelButton = document.querySelector(".cancel-button");
const deleteLabel = document.querySelector(".delete-account-label");

if (deleteButton) {
  deleteButton.addEventListener("click", () => {
    deleteButtonReal.classList.toggle("hidden");
    deleteButton.classList.toggle("hidden");
    cancelButton.classList.toggle("hidden");
    deleteLabel.classList.toggle("hidden");
  });
}

if (cancelButton) {
  cancelButton.addEventListener("click", () => {
    deleteButtonReal.classList.toggle("hidden");
    deleteButton.classList.toggle("hidden");
    cancelButton.classList.toggle("hidden");
    deleteLabel.classList.toggle("hidden");
  });
}

// Stay in the same window position when upvoting post. (Supplied by Hugo).
window.scrollTo(0, sessionStorage.scroll);

window.addEventListener("scroll", () => {
  sessionStorage.setItem("scroll", window.scrollY);
});

// Light/Dark mode button
const toggleBtn = document.querySelector(".toggle");

toggleBtn.addEventListener("click", () => {
  if (toggleBtn.textContent === "🌙") {
    toggleBtn.textContent = "☀️";
  } else {
    toggleBtn.textContent = "🌙";
  }
});
