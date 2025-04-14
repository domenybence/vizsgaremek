const { Builder, By, until } = require('selenium-webdriver');
require("chromedriver");

async function testAdminPanelAccess() {
    let driver = new Builder().forBrowser("chrome").build();
    await driver.manage().window().maximize();

    try {

        await driver.get("http://localhost/");
        await driver.findElement(By.linkText('Bejelentkezés')).click();
        await driver.wait(until.urlContains('bejelentkezes'), 5000);

       
        await driver.findElement(By.name('username')).sendKeys('admin');
        await driver.findElement(By.name('password')).sendKeys('Asd1234!');
        await driver.findElement(By.css('button[type="submit"]')).click();
        await driver.wait(until.titleIs("CodeOverflow"), 5000);
        console.log("Admin bejelentkezés sikeres!");

        await driver.get("http://localhost/admin");
        await driver.wait(until.titleContains("Admin Panel"), 5000);
        console.log("Admin panel megnyílt!");

    
        const heading = await driver.findElement(By.css(".admin-header h1")).getText();
        if (heading.includes("Adminisztrációs Panel")) {
            console.log("Admin panel felirat megtalálva!");
        } else {
            throw new Error("Admin panel nem töltődött be megfelelően.");
        }

        
        await driver.wait(until.elementLocated(By.id("users-table-body")), 5000);
        console.log("Felhasználói tábla betöltve!");

        const editButton = await driver.wait(
            until.elementLocated(By.css("button[data-id='2']")),
            5000
        );
        await driver.wait(until.elementIsVisible(editButton), 5000);
        
      
        await editButton.click();
        console.log("Szerkesztés gomb (ID: 2) sikeresen megnyomva!");

        const modalUsername = await driver.wait(until.elementLocated(By.id('username')), 5000);
        await modalUsername.clear();
        const timestamp = Date.now();
        await modalUsername.sendKeys(`frissitett_felhasznalo${timestamp}`);
        console.log("Felhasználónév módosítva!");

        const saveButton = await driver.findElement(By.id('save-btn'));
        await saveButton.click();
        console.log("Mentés gomb megnyomva!");

        
        console.log("Szerkesztés sikeres!");

    } catch (err) {
        console.error("Hiba az admin panel tesztnél:", err);
    } finally {
        await driver.quit();
    }
}

testAdminPanelAccess();