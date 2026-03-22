# Taste Trail - Digital Recipe Book

An interactive, responsive web application for managing and viewing recipes. Developed for Rajarata University of Sri Lanka.

## Features
- **Responsive Navigation**: Built with Bootstrap 5.
- **Recipe Search**: Dynamic filtering using JavaScript.
- **User Authentication**: Secure Login/Registration with PHP & MySQL.
- **Dynamic Content**: Recipe details via Modals.
- **Contact Form**: Database integration for user queries.
- **Premium UI**: Glassmorphism effect and smooth transitions.

## Setup Instructions

### Prerequisites
- XAMPP or WAMP server.
- Web Browser.

### Installation
1.  **Clone/Download**: Move the project files to your server directory (e.g., `htdocs/taste-trail`).
2.  **Database Setup**:
    - Open `phpMyAdmin`.
    - Create a new database named `taste_trail`.
    - Import the `database.sql` file provided in the root directory.
3.  **Connection Configuration**:
    - Open `includes/db.php`.
    - Ensure host, username, and password match your local environment.
4.  **Launch**:
    - Open your browser and navigate to `http://localhost/taste-trail/index.php`.

## Project Structure
- `auth/`: PHP authentication logic.
- `css/`: Custom CSS styles.
- `js/`: JavaScript interactivity.
- `includes/`: Reusable components and DB connection.
- `images/`: Placeholder images (URLs used).

## Developed By
- ICT/2023/028
- ICT/2023/131
