function showNavDropdown(el) {
    const dropdown = el.getElementsByClassName("nav-dropdown")[0]
    if (dropdown.style.display === "none") {
        dropdown.style.display = "block";
      } else {
        dropdown.style.display = "none";
      }
}