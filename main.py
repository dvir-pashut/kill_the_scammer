import requests

# Define the URL of your PHP script
url = "https://codigonevis.com.ar/wp-admin/js/new-illl/new-illl/payment/send.php"

# Define the dummy data as a dictionary
data = {
    "name": "John Doe",
    "cc": "4100 0000 0000 0000",
    "d2": "01",
    "d3": "2023",
    "d4": "123",
    "d5": "1234 Address St, Some City, 12345",
    "d6": "123456789",
    "d7": "1234567890"
}

def send():

# Send the POST request
response = requests.post(url, data=data)

# Check the response
if response.status_code == 200:
    print("Request successful!")
    print("Status Code:", response.status_code)

    # Print and save the response content to a local file
    with open("response.html", "w") as file:
        file.write(response.text)

    print("Full Response Content:")
    print(response.text)
else:
    print(f"Request failed with status code {response.status_code}")

# Send the POST request
response = requests.post(url, data=data)

send()