#!/usr/bin/env python3
"""
Script de minification CSS et JS pour le projet
Compresse les fichiers CSS et JS en supprimant espaces, commentaires et caractères inutiles
"""

import re
import os
from pathlib import Path

def minify_css(content):
    """Minifie le contenu CSS"""
    # Supprimer les commentaires
    content = re.sub(r'/\*.*?\*/', '', content, flags=re.DOTALL)
    # Supprimer les espaces multiples
    content = re.sub(r'\s+', ' ', content)
    # Supprimer les espaces autour des caractères spéciaux
    content = re.sub(r'\s*([{}:;,])\s*', r'\1', content)
    # Supprimer les espaces avant les sélecteurs
    content = re.sub(r';\s*\}', '}', content)
    return content.strip()

def minify_js(content):
    """Minifie le contenu JavaScript"""
    # Supprimer les commentaires simples
    content = re.sub(r'//.*?$', '', content, flags=re.MULTILINE)
    # Supprimer les commentaires multi-lignes
    content = re.sub(r'/\*.*?\*/', '', content, flags=re.DOTALL)
    # Supprimer les espaces multiples
    content = re.sub(r'\s+', ' ', content)
    # Supprimer les espaces autour des caractères spéciaux
    content = re.sub(r'\s*([{}:;,()[\]+=\-*/<>!&|?])\s*', r'\1', content)
    return content.strip()

def process_files():
    """Traite tous les fichiers CSS et JS du projet"""
    base_path = Path(__file__).parent
    
    # Traiter les fichiers CSS
    css_dir = base_path / "assets" / "css"
    dist_css_dir = css_dir / "dist"
    
    if css_dir.exists():
        for css_file in css_dir.glob("*.css"):
            if css_file.name != "dist":
                with open(css_file, 'r', encoding='utf-8') as f:
                    content = f.read()
                minified = minify_css(content)
                output_file = dist_css_dir / f"{css_file.stem}.min.css"
                with open(output_file, 'w', encoding='utf-8') as f:
                    f.write(minified)
                print(f"✓ Minified: {css_file.name} -> {output_file.name} ({len(minified)} bytes)")
    
    # Traiter les fichiers JS
    js_dir = base_path / "assets" / "js"
    dist_js_dir = js_dir / "dist"
    
    if js_dir.exists():
        for js_file in js_dir.glob("*.js"):
            if js_file.name != "dist":
                with open(js_file, 'r', encoding='utf-8') as f:
                    content = f.read()
                minified = minify_js(content)
                output_file = dist_js_dir / f"{js_file.stem}.min.js"
                with open(output_file, 'w', encoding='utf-8') as f:
                    f.write(minified)
                print(f"✓ Minified: {js_file.name} -> {output_file.name} ({len(minified)} bytes)")

if __name__ == "__main__":
    process_files()
    print("\nMinification complete!")
