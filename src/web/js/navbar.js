

document.addEventListener("DOMContentLoaded", () => {
    
    const menuButton = document.querySelector(".nav-menu-button");
    const nav = document.querySelector("nav");
    const dropdownButtons = document.querySelectorAll(".nav-dropdown-button");
    const dropdownItems = document.querySelectorAll(".nav-dropdown-item");
    let isMenuOpen = false;
    if (window.innerWidth <= 800) {
        gsap.set(nav, {
            x: "-100%"
        });
    }
    menuButton.addEventListener("click", (event) => {
        event.stopPropagation();
        isMenuOpen = !isMenuOpen;
        gsap.to(nav, {
            x: isMenuOpen ? 0 : "-100%",
            duration: 0.3,
            ease: "power2.inOut",
            onComplete: () => {
                if(!isMenuOpen) {
                    resetDropdown()
                }
            }
        });
    });
    document.addEventListener("click", (event) => {
        if(isMenuOpen && !event.target.closest("nav")) {
            isMenuOpen = false;
            gsap.to(nav, {
                x: "-100%",
                duration: 0.3,
                ease: "power2.inOut",
                onComplete: resetDropdown
            });
        }
        dropdownItems.forEach(dropdownItem => {
            if(dropdownItem.classList.contains("visible") && !event.target.closest("nav")) {
                resetDropdown();
            }
        })
    });
    function resetDropdown() {
        dropdownButtons.forEach(button => {
            button.classList.remove("active");
        });
        dropdownItems.forEach(button => {
            button.classList.remove("visible");
            button.style.zIndex = "1000";
        });
    }
    window.addEventListener("resize", () => {
        if(window.innerWidth > 800) {
            gsap.set(nav, {
                x: 0
            });
            isMenuOpen = false;
        }
        else {
            gsap.set(nav, {
                x: "-100%"
            });
            isMenuOpen = false;
        }
        dropdownButtons.forEach(button => {
            button.classList.remove("active");
        });
        dropdownItems.forEach(item => {
            item.classList.remove("visible");
            item.style.zIndex = "1000";
        });
    });
    dropdownButtons.forEach(button => {
    const dropdownItem = button.querySelector(".nav-dropdown-item");
    button.addEventListener("click", (event) => {
        event.stopPropagation();
        const isVisible = dropdownItem.classList.contains("visible");
        dropdownButtons.forEach(selectedButton => {
            if (selectedButton != button) {
                selectedButton.classList.remove("active");
            }
        });
        dropdownItems.forEach(item => {
            if (item != dropdownItem) {
                gsap.to(item, {
                    height: 0,
                    opacity: 0,
                    duration: 0.3,
                    ease: "power2.out",
                    onComplete: () => {
                        item.classList.remove("visible");
                    }
                });
            }
        });
        button.classList.toggle("active");
        if (!isVisible) {
            dropdownItem.classList.add("visible");
            gsap.fromTo(dropdownItem, {
                    height: 0,
                    opacity: 0
                }, {
                    height: "auto",
                    opacity: 1,
                    duration: 0.3,
                    ease: "power2.out"
                });
        }
        else {
            gsap.to(dropdownItem, {
                height: 0,
                opacity: 0,
                duration: 0.3,
                ease: "power2.out",
                onComplete: () => {
                    dropdownItem.classList.remove("visible");
                }
            });
        }
    });
});
});