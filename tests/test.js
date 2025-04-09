let webdriver = require("selenium-webdriver");
const { Builder, By, until } = require('selenium-webdriver');

require("chromedriver");

async function HomeAlap() {

    let driver = new webdriver.Builder()
        .forBrowser("chrome").build();

    try {


        await driver.get("http://localhost/");



        var title = await driver.getTitle();
        console.log('Az oldal címe:', title);

        await driver.findElement(By.id("3")).click();

        const el = await driver.wait(
            until.elementLocated(By.id('kod21')),
            10000
        );


        await driver.wait(until.elementIsVisible(el), 5000);

        var count = await driver.findElements(By.className("card-group")).then(v => v.length);

        console.log("A javascript kategória gombra nyomva ennyi kód jelenik meg: " + count);

        await driver.findElement(By.linkText('Bejelentkezés')).click();
        await driver.wait(until.urlContains('bejelentkezes'), 5000);
        console.log("Bejelentkezés oldalra váltás sikeres!");

        var title = await driver.getTitle();
        console.log('Az oldal címe:', title);

        await driver.findElement(By.name('username')).sendKeys('admin');

        await driver.findElement(By.name('password')).sendKeys('Asd1234!');
        console.log("Adatok feltöltése sikeres!")


        await driver.findElement(By.css('button[type="submit"]')).click();
        console.log("Bejelentkezés gomb megnyomása sikeres!")
        const el2 = await driver.wait(
            until.elementLocated(By.linkText('CodeOverflow')),
            10000
        );


        await driver.wait(until.elementIsVisible(el2), 5000);;


        var title = await driver.getTitle();

        if (title == "CodeOverflow") {
            console.log("Sikeres bejelentkezés!");
        }
        else {
            console.log("Sikertelen bejelentkezés!");
        }
        console.log('Az oldal címe:', title);

        console.log('Pontfeltöltés oldalra váltás!')
        const dropdownToggle = await driver.findElement(By.id('navusername'));
        await dropdownToggle.click();


        const dropdownButton = await driver.wait(
            until.elementLocated(By.linkText('Pontok feltöltése')),
            5000
        );


        await dropdownButton.click();


        await driver.wait(until.urlContains('/pontfeltoltes'), 5000);

        console.log('Siker!')

        var title = await driver.getTitle();
        console.log('Az oldal címe:', title);

        await driver.findElement(By.id('points')).sendKeys('30');

        console.log("Kívánt pontok megadása sikeres!")


        await driver.findElement(By.className('button-input')).click();

        const el3 = await driver.wait(
            until.elementLocated(By.id('responseMessage')),
            5000
        );

        const messageText = await el3.getText();


        console.log(messageText)

        await driver.quit();


    } catch (err) {
        console.error('Hiba:', err);
        await driver.quit();
    }
}


HomeAlap()
