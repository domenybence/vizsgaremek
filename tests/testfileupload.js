const fs = require('fs');
const path = require('path');
const { Builder, By, until } = require('selenium-webdriver');
require("chromedriver");

async function testFileUpload() {
    let driver = new Builder().forBrowser("chrome").build();
    await driver.manage().window().maximize();
    
    const timestamp = Date.now();
    const fileName = `testupload_${timestamp}.txt`;
    const filePath = path.resolve(__dirname, fileName);

    fs.writeFileSync(filePath, 'Automated test file content.');

    try {
      
        await driver.get("http://localhost/");
        await driver.findElement(By.linkText('Bejelentkezés')).click();
        await driver.wait(until.urlContains('bejelentkezes'), 5000);
        await driver.findElement(By.name('username')).sendKeys('admin');
        await driver.findElement(By.name('password')).sendKeys('Asd1234!');
        await driver.findElement(By.css('button[type="submit"]')).click();
        await driver.wait(until.titleIs("CodeOverflow"), 5000);
        console.log("Bejelentkezés sikeres!");

        
        const dropdown = await driver.findElement(By.id('navusername'));
        await dropdown.click();
        const uploadLink = await driver.wait(until.elementLocated(By.linkText('Kód feltöltése')), 5000);
        await uploadLink.click();
        await driver.wait(until.urlContains('kodfeltoltes'), 5000);
        console.log("Feltöltés oldal betöltve!");

        // STEP 3: Fill out the form
        await driver.findElement(By.id('nevInput')).sendKeys(`Teszt Szoftver ${timestamp}`);
        await driver.findElement(By.id('arInput')).clear();
        await driver.findElement(By.id('arInput')).sendKeys('1000');

        const categorySelect = await driver.wait(until.elementLocated(By.id('katInput')), 5000);
        await driver.wait(until.elementIsVisible(categorySelect), 5000);
        const options = await driver.findElements(By.css('#katInput option'));
        if (options.length > 1) {
            await options[1].click(); 
        }

        await driver.findElement(By.id('fileToUpload')).sendKeys(filePath);
        console.log("Fájl kiválasztva:", fileName);

    
        await driver.findElement(By.css('button[type="submit"]')).click();

        await driver.wait(until.alertIsPresent(), 5000);

        let alert = await driver.switchTo().alert();
        console.log("Alert szövege:", await alert.getText());
        await alert.accept(); 

        await driver.wait(until.urlContains('upload'), 5000);
        console.log("Feltöltés megtörtént");

    } catch (err) {
        console.error('Hiba a feltöltés tesztnél:', err);
    } finally {
        await driver.quit();

        if (fs.existsSync(filePath)) {
            fs.unlinkSync(filePath);
            console.log("Tesztfájl törölve:", fileName);
        }
    }
}

testFileUpload();