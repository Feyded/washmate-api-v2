# Overview and Guidelines for Code Standard

## Project Overview

This project is built using:

- Laravel 13.29.0
- PHP 8.3.24+
- laravel/sanctum 4.0+ (Sanctum SPA authentication)
- MySQL Database
- maatwebsite/excel: 4.0+ (Generating Excel)
- barryvdh/laravel-dompdf: 3.1+ (Generating PDF)

The goal is to maintain a clean, scalable, secure, and production-ready
API architecture that is easy to maintain and extend.

## General Principles

- Follow Laravel 13 convention.
- Follow SOLID principles.
- Follow DRY (Don't Repeat Yourself).
- Follow KISS (Keep It Simple).
- Prefer readability over clever code.
- Prefer maintainability over premature optimization.
- Avoid unnecessary abstractions.
- Production-ready code only.
- Use a hybrid architecture with feature-based organization.
- Organize code by domain/feature before technical layer.
