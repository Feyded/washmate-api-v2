# Overview and Guidelines for Code Standard

## Project Overview

This project is built using:

- Laravel 10.10
- PHP 8.1+
- Laravel Sanctum (Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- Laravel Socialite (OAuth Authentication)
- PhpSpreadsheet (Excel Exports)
- DomPDF (PDF Generation)
- MySQL Database

The goal is to maintain a clean, scalable, secure, and production-ready
API architecture that is easy to maintain and extend.

All generated code should follow existing project patterns before
introducing new implementations.

## General Principles

- Follow SOLID principles.
- Follow DRY (Don't Repeat Yourself).
- Follow KISS (Keep It Simple).
- Prefer readability over clever code.
- Prefer maintainability over premature optimization.
- Avoid unnecessary abstractions.
- Production-ready code only.
- Use a hybrid architecture with feature-based organization.
- Organize code by domain/feature before technical layer.
