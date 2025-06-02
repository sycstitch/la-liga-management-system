⚽ La Liga EA Sports Management System
A comprehensive database project exploring Spanish football league management, built as a collaborative learning experience between friends from different cultures.
   
✨ What We Built
🔄 Full CRUD Operations
	- Create: Add new matches, players, and teams to the system
	- Read: Browse league data with dynamic dashboards
	- Update: Modify match results, player info, team rosters
	- Delete: Remove records (with confirmation because... mistakes happen)

📊 Complex Database Analysis
We implemented four advanced queries that actually taught us SQL:
	- Referee Performance Analytics - Who's officiating the most matches?
	- Cross-Team Salary Analysis - Comparing Real Madrid vs Barcelona player salaries
	- Match History Tracking - Complete referee assignment records
	- Club Roster Management - Full team listings with player details

[Detailed query analysis and results available in /docs/query-analysis.md]
🔒 Security & Architecture
	- Prepared Statements for SQL injection protection
	- Session Management with automatic timeout
	- Input Validation and error handling
	- Modular PHP with clean separation of concerns

🛠️ Tech Stack
  - Backend: PHP 7.4+ with PDO, MySQL/MariaDB
  - Frontend: HTML5, Foundation CSS, JavaScript
  - Architecture: MVC-inspired structure with reusable components

🏃‍♂️ Quick Start
```
# Clone and set up
git clone https://github.com/yourusername/la-liga-management-system.git
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

🗂️ Project Structure
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

🌟 The Story Behind This
This started as a database systems assignment, but became something more interesting. Working with my Venezuelan friend Andres, we decided to tackle La Liga instead of the usual generic sports database. Why? Because I wanted to practice my Spanish, he brought authentic South American football passion, and we both figured—why not make our schoolwork actually engaging?
Building a database around something you're genuinely curious about makes all the difference. Every query became a conversation about football culture, every table design sparked debates about how Spanish football actually works.

🎯 What This Could Become
While this is definitely academic work, we built it with real-world thinking. The foundation here could power:
	- Club Management: Real-time roster updates, player contract tracking
	- League Operations: Match scheduling, referee assignments, stadium management
	- Performance Analytics: Player statistics, team performance tracking
	- Fan Engagement: Match results, player information, league standings

🎓 What We Learned
Database Design - ERD creation actually helps, normalization makes sense with real relationshipsPHP Development - PDO beats old mysql_* functions, session management is trickier than expectedCross-Cultural Collaboration - Having a native Spanish speaker made all the differenceSpanish Practice - Technical vocabulary in Spanish is fascinating, football terminology translates unexpectedly

🔮 Future Ideas
Maybe Eventually: Better UI, mobile responsiveness, API developmentProbably Not But Cool: Machine learning predictions, real La Liga data feeds, mobile app

👨‍💻 The Team
Lauren Williams-Riddle - Database design, PHP development, Spanish practice victim
Andres Torrado - Venezuelan football expertise, complex queries, cultural authenticity

🙏 Thanks To
Andres for putting up with my Spanish and bringing real football knowledge 
Professor for letting us pick our own topic 
La Liga for existing and being fascinating 
Stack Overflow for obvious reasons

📚 Development Notes
For a complete history of code cleanup and security improvements made before public release, see CLEANUP-CHANGELOG.md.

🌐 A Note on Language
Yeah, we built this partly as Spanish practice. Every team name, stadium, and data relationship comes from real La Liga context. It's academic work, but it's also a love letter to Spanish football culture—and honestly, that made the whole project way more engaging than another generic "Library Management System."

¡Hasta la vista, baby! ⚽ (Wrong country, but you get the idea)