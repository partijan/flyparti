package cz.borzensky;

import java.util.concurrent.TimeUnit;
import org.junit.*;
import static org.junit.Assert.*;
import org.openqa.selenium.*;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.chrome.ChromeDriver;

import org.openqa.selenium.support.ui.Select;

/**
 * Created by JiÅ™Ã­ on 05.09.2016.
 */
public class Test2Java {
    private WebDriver driver;
    private String baseUrl;
    private boolean acceptNextAlert = true;
    private StringBuffer verificationErrors = new StringBuffer();

    @Before
    public void setUp() throws Exception {
        

        System.setProperty("webdriver.chrome.driver", "D:\\chromedriver.exe");
        driver = new ChromeDriver();
        baseUrl = "http://www.flyparti.coml/index.php";
        driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
    }

    @Test
    public void test2Java() throws Exception {
        driver.get(baseUrl + "");
        driver.findElement(By.linkText("Destinace")).click();
        driver.findElement(By.linkText("VIP servis")).click();
        driver.findElement(By.linkText("Reference")).click();
        driver.findElement(By.linkText("Kontakt")).click();
        driver.findElement(By.linkText("Destinace")).click();
        driver.findElement(By.linkText("Slovensko")).click();
        driver.findElement(By.linkText("Reference")).click();
        driver.findElement(By.linkText("Kontakt")).click();
        driver.findElement(By.linkText("Prihlašení")).click();
        driver.findElement(By.id("username")).clear();
        driver.findElement(By.id("username")).sendKeys("parti");
        driver.findElement(By.id("password")).clear();
        driver.findElement(By.id("password")).sendKeys("heslo");
        driver.findElement(By.cssSelector("input[type=\"submit\"]")).click();
        driver.findElement(By.linkText("VIP servis")).click();
        driver.findElement(By.linkText("Reference - pøidat")).click();
        driver.findElement(By.linkText("Destinace - pøidat")).click();
        driver.findElement(By.linkText("Destinace - editovat")).click();
        driver.findElement(By.linkText("Destinace - editovat")).click();
        driver.findElement(By.linkText("Destinace - pøidat")).click();
        driver.findElement(By.linkText("Reference - pøidat")).click();
        driver.findElement(By.linkText("VIP servis")).click();
        driver.findElement(By.linkText("Odhlašení")).click();
        driver.findElement(By.id("username")).clear();
        driver.findElement(By.id("username")).sendKeys("parti");
        driver.findElement(By.id("password")).clear();
        driver.findElement(By.id("password")).sendKeys("heslo");
    }

    @After
    public void tearDown() throws Exception {
        driver.quit();
        String verificationErrorString = verificationErrors.toString();
        if (!"".equals(verificationErrorString)) {
            fail(verificationErrorString);
        }
    }

    private boolean isElementPresent(By by) {
        try {
            driver.findElement(by);
            return true;
        } catch (NoSuchElementException e) {
            return false;
        }
    }

    private boolean isAlertPresent() {
        try {
            driver.switchTo().alert();
            return true;
        } catch (NoAlertPresentException e) {
            return false;
        }
    }

    private String closeAlertAndGetItsText() {
        try {
            Alert alert = driver.switchTo().alert();
            String alertText = alert.getText();
            if (acceptNextAlert) {
                alert.accept();
            } else {
                alert.dismiss();
            }
            return alertText;
        } finally {
            acceptNextAlert = true;
        }
    }
}
