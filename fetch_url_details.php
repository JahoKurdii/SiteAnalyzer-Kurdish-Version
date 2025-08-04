                <?php
                // Your PHP logic for fetching URL info goes here
                $headers = '';
                $body = '';
                $http_code = null;
                $header_size = null;
                $ip = '';
                $data = null;
                $error_message = '';
                $request_method = '';

                if(isset($_POST['submit'])){
                    // This script will execute on page load after form submission
                    // The loading overlay will be active until the new page loads.
                    // For a smoother experience without full page reload, you'd need AJAX.

                    $url = $_POST['url'];
                    $request_method = $_POST['method'] ?? 'GET';

                    if (filter_var($url, FILTER_VALIDATE_URL)) {
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HEADER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (for development)
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set a timeout for cURL

                        // Set HTTP method
                        if ($request_method === 'POST') {
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, ''); // Send an empty body for POST if no specific data is provided
                        } else { // Default to GET
                            curl_setopt($ch, CURLOPT_HTTPGET, true);
                        }

                        $response = curl_exec($ch);
                        if ($response === false) {
                            $error_message = curl_error($ch) .  ': خەلەتیەک یا هەی' ;
                        } else {
                            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                            $headers = substr($response, 0, $header_size);
                            $body = substr($response, $header_size); // The actual response body

                            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                            $host = parse_url($url, PHP_URL_HOST);
                            if ($host) {
                                $ip = gethostbyname($host);
                                if ($ip && $ip !== $host) { // Check if gethostbyname actually returned an IP
                                    $ip_api_response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,zip,lat,lon,timezone,isp,org,query");
                                    if ($ip_api_response === false) {
                                        $error_message .= ' Could not fetch IP details from ip-api.com.';
                                    } else {
                                        $data = json_decode($ip_api_response, true);
                                        if (json_last_error() !== JSON_ERROR_NONE) {
                                            $error_message .= ' Error decoding IP API response.';
                                        }
                                    }
                                } else {
                                    $error_message .= ' Could not resolve host IP address.';
                                }
                            } else {
                                $error_message .= ' ئەڤ مالپەرە خەلەتە.';
                            }
                        }
                        curl_close($ch);
                    } else {
                        $error_message = 'ماپلەرەکێ دروست داخل کە.';
                    }
                }
                ?>