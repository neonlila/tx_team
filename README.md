# TYPO3 Extension `tx_team`

![TYPO3 Version](https://img.shields.io/badge/TYPO3-v13%20%7C%20v14-orange.svg?style=flat-square)
![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-blue.svg?style=flat-square)
![License](https://img.shields.io/badge/License-GPL--2.0--or--later-green.svg?style=flat-square)

A lightweight, modern TYPO3 Extbase extension for managing and displaying team members and departments. Features dynamic department filtering, interactive Bootstrap detail modals, responsive grid displays, custom avatar cropping, and seamless Site Sets integration.

---

## 📸 Frontend Preview

![Team Directory Preview](  <img src="https://raw.githubusercontent.com/neonlila/tx_team/master/Resources/Public/images/tx_team_frontend.png" alt="Frontend Team Modul" width="100%" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
)

---

## ✨ Features

- **Extbase & Fluid Architecture:** Clean separation of concerns fully aligned with modern TYPO3 standards (v13 / v14).
- **Department Filtering:** Quick, single-action filtering of team members by department.
- **Interactive Detail Modals:** Full biography, department tags, and social link previews inside responsive Bootstrap 5 modal overlays.
- **Image Cropping:** Native image crop variants support for 1:1 square profile avatars.
- **Site Sets Integration:** Native TYPO3 Site Sets support (`neon/site-team`) for modern TypoScript configuration management.
- **PSR-11 Auto-wiring:** Full dependency injection setup using standard `Services.yaml` configurations.

---

## ⚙️ Complete Installation & Setup Guide

### Step 1: Install via Composer

Add the extension repository to your root `composer.json` or install it directly via Composer:

```bash
composer require neon/tx-team
```

### Step 2: Configure Database Schema (ext_tables.sql)

Ensure your extension includes ext_tables.sql in the root directory to define the required database structures for members and departments:
```text
#
# Table structure for table 'tx_team_domain_model_member'
#
CREATE TABLE tx_team_domain_model_member (
    name varchar(255) DEFAULT '' NOT NULL,
    position varchar(255) DEFAULT '' NOT NULL,
    bio text DEFAULT '' NOT NULL,
    linkedin varchar(255) DEFAULT '' NOT NULL,
    department int(11) unsigned DEFAULT '0' NOT NULL,
    photo int(11) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_team_domain_model_department'
#
CREATE TABLE tx_team_domain_model_department (
    title varchar(255) DEFAULT '' NOT NULL
);
```

### Step 3: Run Database Migrations

Apply the database schema changes to your database using DDEV, the TYPO3 CLI or backend

### Step 4: Include the Site Set

Include the Site Team Set (neon/site-team) in your site package's config.yaml or through the TYPO3 Backend under Site Management > Sites:
```text
dependencies:
  - "neon/site-team"
```

### Step 5: Configure Storage PID

Define the PID where your Team Member and Department records are stored in Configuration/Sets/SiteTeam/constants.typoscript:

```bash
plugin.tx_team {
    persistence {
        # cat=plugin.tx_team/file; type=int+; label=Storage Folder PID: Page ID where team member and department records are stored
        storagePid = 14
    }
}
```

### Step 6: Flush System Caches

```bash
ddev typo3 cache:flush
```

## 🏗️ Project Architecture & File Structure

```text
tx_team/
├── Classes/
│   ├── Controller/
│   │   └── MemberController.php
│   ├── Domain/
│   │   ├── Model/
│   │   │   ├── Department.php
│   │   │   └── Member.php
│   │   └── Repository/
│   │       ├── DepartmentRepository.php
│   │       └── MemberRepository.php
├── Configuration/
│   ├── Extbase/
│   │   └── Persistence/
│   │       └── Classes.php
│   ├── Sets/
│   │   └── SiteTeam/
│   │       ├── config.yaml
│   │       ├── constants.typoscript
│   │       ├── page.tsconfig
│   │       └── setup.typoscript
│   ├── TCA/
│   │   ├── Overrides/
│   │   │   └── tt_content.php
│   │   ├── tx_team_domain_model_department.php
│   │   └── tx_team_domain_model_member.php
│   └── Services.yaml
├── Resources/
│   ├── Private/
│   │   ├── Language/
│   │   │   └── locallang_db.xlf
│   │   └── Templates/
│   │       └── Member/
│   │           └── List.html
│   └── Public/
│       └── Images/
│           └── tx_team_frontend.png
├── composer.json
├── ext_localconf.php
└── ext_tables.sql
```

## 🧩 Component & File Breakdown

### 🗄️ Database & Schema (ext_tables.sql & Configuration/TCA/)

- ext_tables.sql: Relational database table definitions for member and department records.
- TCA/tx_team_domain_model_member.php: Table Configuration Array defining backend input forms for members, including image crop variants (1:1 square avatar), Rich Text Editor (CKEditor) for bio text, and relation select inputs for departments.
- TCA/tx_team_domain_model_department.php: Backend form configuration for department management.
- TCA/Overrides/tt_content.php: Registers the txteam_teamlist content element plugin into the tt_content record options via ExtensionUtility::registerPlugin().

## 🎮 Controllers (Classes/Controller/)

MemberController.php

Handles user interaction and requests for displaying team listings. Uses PHP 8 constructor injection to load MemberRepository and   DepartmentRepository.

- listAction(int $department = 0): Retrieves all team members or filters members by the selected $department UID, fetches department categories for tab navigation, and passes data to the Fluid view.

## 📦 Domain Models (Classes/Domain/Model/)

Member.php

Extbase domain model (AbstractEntity) mapping member records. Contains properties, getters, and setters for $name, $position, $bio, $linkedin, $photo (FileReference), and $department (Department).

Department.php

Extbase domain model (AbstractEntity) mapping department categories with a $title property.

## 🗄️ Repositories (Classes/Domain/Repository/)

MemberRepository.php

Handles database operations for Member models.
- findByDepartmentUid(int $departmentUid): Custom query execution that filters team members by target department relationship.
- initializeObject(): Configures Typo3QuerySettings (such as setting setRespectStoragePage(false) if fallback behavior is needed).

DepartmentRepository.php

Handles persistence and sorting (sorting ASC) for department models.

## ⚙️ Configuration Files (Configuration/)

- Services.yaml: Configures PSR-11 Dependency Injection with auto-wiring enabled for controllers and repositories under the Neon\TxTeam\ namespace.
- ext_localconf.php: Configures plugin routing using Extbase's ExtensionUtility::configurePlugin().
- Extbase/Persistence/Classes.php: Explicitly maps PHP Domain Models (Member, Department) to their corresponding database tables (tx_team_domain_model_member, tx_team_domain_model_department).
- Sets/SiteTeam/:
    - config.yaml: Registers the Site Set for TYPO3 v13/v14.
    - setup.typoscript: Configures CType rendering (tt_content.txteam_teamlist = USER), persistence mappings, and Fluid template root paths.
    - constants.typoscript: Defines storage PID parameters for the TypoScript Constant Editor.
    - page.tsconfig: Adds the Team List plugin to the TYPO3 New Content Element Wizard under Plugins.

## 🎨 Templates (Resources/Private/Templates/)

- Member/List.html: Primary Fluid view rendering:
    - Responsive department navigation tabs with active class highlighting.
    - Bootstrap 5 grid displaying member cards with cropped avatars, job titles, and department badges.
    - Interactive Bootstrap modal popups triggered on card click showing full bio text and LinkedIn links.

This extension is open-source software licensed under the GPL-2.0-or-later.

TODO: 

- [ ] add a variaty of layouts to showcase the team members
- [ ] add some new fields to member
- [ ] add icons/colors to department
