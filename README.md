# SkillBuilder – Symfony Lernplattform

**SkillBuilder** ist eine moderne Web-Anwendung zur Verwaltung von Kursen und Lernfortschritten.  
Das Projekt dient als praxisnahes Symfony-Portfolio, um professionelle Webentwicklung zu demonstrieren.

## 🚀 Technologien

- **Symfony 6 / 7**
- **PHP 8.2**
- **Doctrine ORM**
- **Twig**
- **Bootstrap (optional)**
- **Git & GitHub**
- **SQLite / MySQL (frei wählbar)**

## 🎯 Hauptfunktionen (geplant & aktiv in Entwicklung)

- Kurse anlegen, bearbeiten und löschen  
- Lektionen (Lessons) verwalten  
- Fortschritt speichern  
- Benutzerverwaltung (Login, Rollen)  
- Dashboard für Lernstatus  
- API-Endpunkte für externe Nutzung  
- Saubere MVC-Architektur + Doctrine-Entities  
- Echte Deployment-Struktur für spätere Veröffentlichung

## 📂 Projektstruktur (Auszug)

skillbuilder/
├─ assets/                     # Webpack Encore / Frontend Assets (CSS, JS)
│   └─ controllers/            # Stimulus Controller (optional)
│
├─ bin/                        # Symfony CLI / Console
│   └─ console                 # CLI-Befehle
│
├─ config/                     # Framework- & Bundle-Konfigurationen
│   ├─ packages/               # Doctrine, Twig, Mailer, Security, etc.
│   ├─ routes/                 # YAML- oder PHP-basierte Routen
│   └─ services.yaml           # Dependency Injection + Services
│
├─ migrations/                 # Doctrine-Migrations für DB-Versionierung
│   └─ VersionXXXX.php         # Jede Migration ist eine Datei
│
├─ public/                     # Webserver Document Root
│   ├─ index.php               # Front Controller
│   └─ build/                  # kompiliertes CSS/JS
│
├─ src/                        # Der eigentliche PHP-Code deines Projekts
│   ├─ Controller/             # Alle Symfony-Controller (z.B. HomeController)
│   ├─ Entity/                 # Doctrine Entities (z.B. Lesson.php)
│   ├─ Repository/             # Abfragen/Repositories für Doctrine
│   ├─ Security/               # Login, User Provider, Authenticator
│   └─ Kernel.php              # Der App-Kernel
│
├─ templates/                  # Twig Templates (Views)
│   ├─ base.html.twig          # Layout (Header, Footer)
│   └─ home/                   # Ordner für einzelne Views
│
├─ tests/                      # PHPUnit Tests
│   └─ Unit/                   # Unit Tests
│   └─ Functional/             # Controller / Router Tests
│
├─ translations/               # Mehrsprachige Strings (optional)
│
├─ var/                        # Cache, Logs, SQLite-DB
│   ├─ cache/
│   └─ log/
│
├─ vendor/                     # Composer Dependencies (automatisch)
│
├─ .env                        # Umgebungsvariablen (DB, ENV, Secrets)
├─ composer.json               # Composer-Konfiguration
├─ symfony.lock                # Lock-Datei für Bundle-Versionen
└─ README.md                   # Dokumentation 

--------------------------------------------------------
@startuml
title SkillBuilder – Kernklassen (Stand: erstes Modul)

package "Web Layer" {
  class HomeController {
    + index(): Response
  }
}

package "Domain Layer" {
  class Lesson {
    - id: int
    - title: string
    - description: string
    - durationMinutes: int
    - isCompleted: bool
    - createdAt: DateTimeImmutable
    --
    + getId(): int
    + getTitle(): string
    + setTitle(title: string): self
    + getDescription(): string
    + setDescription(description: string): self
    + getDurationMinutes(): int
    + setDurationMinutes(minutes: int): self
    + isCompleted(): bool
    + setCompleted(completed: bool): self
    + getCreatedAt(): DateTimeImmutable
  }
}

package "Persistence Layer" {
  class LessonRepository {
    + find(id: int): ?Lesson
    + findAll(): array<Lesson>
    + findByTitle(title: string): array<Lesson>
    + add(lesson: Lesson, flush: bool = false): void
    + remove(lesson: Lesson, flush: bool = false): void
  }
}

HomeController --> LessonRepository : benutzt
LessonRepository --> Lesson : verwaltet

@enduml

--------------------------------------------------------

@startuml
title Request-Ablauf: Benutzer ruft /home auf

actor User
participant "Browser" as B
participant "Symfony Router" as R
participant "HomeController" as C
participant "LessonRepository" as Repo
participant "Twig Engine" as T

User -> B : URL eingeben\nhttp://127.0.0.1:8001/home
B -> R : HTTP GET /home
R -> C : index()

C -> Repo : findAll()
Repo --> C : Liste<Lesson>

C -> T : render('home/index.html.twig', { lessons })
T --> C : HTML
C --> B : HTTP 200 + HTML
B --> User : Seite „Symfony Kurs – Tag 1“

@enduml



