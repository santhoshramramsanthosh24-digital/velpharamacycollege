<?php
/**
 * VEL Pharmacy College - NEP 2020 Curriculum & Syllabus Database Loader
 * Official Pharmacy Council of India (PCI) 2026 Regulations (NEP 2020)
 * 193 Total Credits across 8 Semesters with 88 Complete Subject Modules
 */

$json_path = __DIR__ . '/syllabus_nep2020.json';
if (file_exists($json_path)) {
    $nep_syllabus_data = json_decode(file_get_contents($json_path), true);
} else {
    $nep_syllabus_data = [];
}
