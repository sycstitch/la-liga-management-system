# ⚽ La Liga EA Sports Management System

A comprehensive database project exploring Spanish football league management, built as a collaborative learning experience between friends from different cultures.

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg?style=for-the-badge)](https://www.php.net/downloads)
[![Database](https://img.shields.io/badge/Database-MySQL-orange.svg?style=for-the-badge)](https://www.mysql.com/downloads/)

## ✨ What We Built

### 🔄 Full CRUD Operations
- **Create**: Add new matches, players, and teams to the system
- **Read**: Browse league data with dynamic dashboards  
- **Update**: Modify match results, player info, team rosters
- **Delete**: Remove records (with confirmation because... mistakes happen)

### 📊 Complex Database Analysis

We implemented four advanced queries that actually taught us SQL:
- **Referee Performance Analytics** - Who's officiating the most matches?
- **Cross-Team Salary Analysis** - Comparing Real Madrid vs Barcelona player salaries
- **Match History Tracking** - Complete referee assignment records
- **Club Roster Management** - Full team listings with player details

*[Detailed query analysis and results available in [query-analysis.md](/docs/query-analysis.md)]*

### 🔒 Security & Architecture

- **Prepared Statements** for SQL injection protection
- **Session Management** with automatic timeout
- **Input Validation** and error handling
- **Modular PHP** with clean separation of concerns

<br /><br />

## 🛠️ Tech Stack

**Backend:** PHP 7.4+ with PDO, MySQL/MariaDB  
**Frontend:** HTML5, Foundation CSS, JavaScript  
**Architecture:** MVC-inspired structure with reusable components

<br /><br />

## Setup
<details>
<summary>🏃‍♂️ Quick Start</summary>

```bash
# Clone and set up
git clone https://github.com/sycstitch/la-liga-management-system.git
cd la-liga-management-system

# Database setup
CREATE DATABASE laliga_management;
# Import schema: database/schema.sql
# Import sample data: database/sample-data.sql

# Update src/config/config.example.php with your credentials
# Copy to src/config/config.php

# Launch with: php -S localhost:8000 -t src
# Visit: http://localhost:8000/index.php
```
</details>

<details>
<summary>Detailed Setup</summary>

1. Clone the repository
```bash
bashgit clone https://github.com/sycstitch/la-liga-management-system.git
cd la-liga-management-system
```

2. Set up your database
```sql
CREATE DATABASE laliga_management;
USE laliga_management;
SOURCE database/schema.sql;
SOURCE database/sample-data.sql;
```

3. Configure database connection
```bash
# Copy the configuration template
cp src/config/config.example.php src/config/config.php

# Edit with your database credentials
nano src/config/config.php  # or use your preferred editor
```

4. Update config.php with your credentials
```php
define('DBHOST', 'localhost');
define('DBNAME', 'laliga_management');
define('USERNAME', 'your_database_username');
define('PASSWORD', 'your_database_password');
```

5. Launch the application
```bash
# Start PHP development server
php -S localhost:8000 -t src

# Open in your browser
# http://localhost:8000/index.php
```

</details>

<details>
<summary>Troubleshooting</summary>
    
Database connection issues:
- Verify your MySQL/MariaDB service is running
- Check your credentials in src/config/config.php
- Ensure the database laliga_management exists

File not found errors:
- Make sure you're serving from the src directory: `php -S localhost:8000 -t src`
- Check that all files are in the correct folder structure

Permission errors:
- Ensure PHP has read access to all project files
- On Unix systems, you may need: `chmod -R 755 la-liga-management-system`
</details>
<br /><br />

## 🗂️ Project Structure
```
la-liga-management-system/
├── 📁 src/                           # Source code (main application)
│   ├── 📄 index.php                  # Main dashboard - start here
│   ├── 📄 create-match.php           # Add new matches
│   ├── 📄 edit-match.php             # Edit existing matches  
│   ├── 📄 delete-match.php           # Remove matches (with confirmation)
│   ├── 📁 analytics/                 # Analytics modules
│   │   ├── 📄 referee-analytics.php  # Referee performance analytics
│   │   ├── 📄 salary-analysis.php    # Cross-team salary analysis
│   │   ├── 📄 referee-history.php    # Referee match assignment history
│   │   └── 📄 club-rosters.php       # Complete club roster management
│   ├── 📁 includes/                  # Shared utilities
│   │   ├── 📄 database.php           # PDO connection with error handling
│   │   ├── 📄 session.php            # Session management
│   │   └── 📄 functions.php          # Shared utility functions
│   └── 📁 config/
│       └── 📄 config.example.php     # Database configuration template
├── 📁 database/                      # Database files
│   ├── 📄 schema.sql                 # Table creation script
│   ├── 📄 sample-data.sql            # Sample La Liga data
│   └── 📄 queries.sql                # Raw SQL queries for reference
├── 📁 assets/                        # Static resources
│   ├── 📁 css/                       # Foundation framework & styles
│   ├── 📁 js/                        # JavaScript functionality
│   └── 📁 images/                    # Screenshots and visual assets
└── 📁 docs/                          # Documentation
    ├── 📄 query-analysis.md          # Detailed SQL query analysis
    └── 📄 CLEANUP-CHANGELOG.md       # Development history and security fixes
```
<br /><br />

## 🌟 The Story Behind This

This started as a database systems assignment, but became something more interesting. Working with my Venezuelan friend Andres, we decided to tackle La Liga instead of the usual generic sports database. Why? Because I wanted to practice my Spanish, he brought authentic South American football passion, and we both figured—why not make our schoolwork actually engaging?

Building a database around something you're genuinely curious about makes all the difference. Every query became a conversation about football culture, every table design sparked debates about how Spanish football actually works.
<br /><br />

## 🎯 What This Could Become

While this is definitely academic work, we built it with real-world thinking. The foundation here could power:

- **Club Management**: Real-time roster updates, player contract tracking
- **League Operations**: Match scheduling, referee assignments, stadium management  
- **Performance Analytics**: Player statistics, team performance tracking
- **Fan Engagement**: Match results, player information, league standings
<br /><br />

## 🎓 What We Learned

- **Database Design** - ERD creation actually helps, normalization makes sense with real relationships
- **PHP Development** - PDO beats old mysql_* functions, session management is trickier than expected
- **Cross-Cultural Collaboration** - Having a native Spanish speaker made all the difference
- **Spanish Practice** - Technical vocabulary in Spanish is fascinating, football terminology translates unexpectedly
<br /><br />

## 🔮 Future Ideas

- **Maybe Eventually:** Better UI, mobile responsiveness, API development
- **Probably Not But Cool:** Machine learning predictions, real La Liga data feeds, mobile app
<br /><br />

## 👨‍💻 The Team

- **Lauren Williams-Riddle** - Database design, PHP development, Spanish practice victim  
- **Andres Torrado** - Venezuelan football expertise, complex queries, cultural authenticity
<br /><br />

## 🙏 Thanks To

- **Andres** for putting up with my Spanish and bringing real football knowledge
- **Professor** for letting us pick our own topic
- **La Liga** for existing and being fascinating
- **Stack Overflow** for obvious reasons

---

### 🌐 A Note on Language

Yeah, we built this partly as Spanish practice. Every team name, stadium, and data relationship comes from real La Liga context. It's academic work, but it's also a love letter to Spanish football culture—and honestly, that made the whole project way more engaging than another generic "Library Management System."

**¡Hasta la vista, baby! ⚽** (Wrong country, but you get the idea)
