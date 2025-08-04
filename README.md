Preview : 

<img width="1920" height="925" alt="image" src="https://github.com/user-attachments/assets/ffb57cd6-8d82-45b2-8b54-e8a8e8c1c8ea" />
# Kurdish URL Info Tool (PHP)

A PHP script that allows Kurdish users to fetch and inspect website information by entering a URL and HTTP method (GET or POST). It retrieves the website’s headers, body, HTTP status code, and resolves the IP address, then shows location and ISP details using the ip-api.com service.

## Features

- Supports GET and POST requests
- Shows full response headers and body
- Displays HTTP status code
- Resolves hostname to IP address
- Fetches IP location, ISP, and other metadata from ip-api.com
- Error messages and prompts shown in Kurdish for local users

## Usage

1. Upload `url_info.php` (or your chosen filename) to a PHP-enabled web server.
2. Access the script in a browser.
3. Enter the URL and select the HTTP method.
4. Submit the form to see detailed response and IP info.
5. Errors and messages will appear in Kurdish.

## Requirements

- PHP with cURL enabled
- Internet access for fetching IP data from ip-api.com

## Notes

- SSL verification is disabled for development (can be enabled for production).
- For smoother experience without page reload, AJAX integration can be added.

## License

This project is open-source and free to use.

---

**Developed by JahoKurdi**  
[https://jahokurdi.com](https://jahokurdi.com)
