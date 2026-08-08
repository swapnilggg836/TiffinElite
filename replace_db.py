import re
import os
import glob
import shutil

backup_dir = r"c:\xampp\htdocs\yum_backup"
source_dir = r"c:\xampp\htdocs\yum"

if not os.path.exists(backup_dir):
    shutil.copytree(source_dir, backup_dir)
    print("Backup created at", backup_dir)

files = glob.glob(os.path.join(source_dir, "*.php"))
changes_made_files = []

for file in files:
    if file.endswith('connection.php') or file.endswith('fix_db.py') or file.endswith('test_regex.py') or file.endswith('replace_db.py'):
        continue
        
    with open(file, 'r', encoding='utf-8', errors='ignore') as f:
        content = f.read()
        
    initial_content = content
    
    # Inline replacement
    inline_pattern = r'\$conn\s*=\s*new\s*mysqli\s*\(\s*["\']localhost["\']\s*,\s*["\']root["\']\s*,\s*["\']["\']\s*,\s*["\']yum["\']\s*\)\s*;[^\n]*'
    content = re.sub(inline_pattern, r"require_once 'connection.php';", content)
    
    # Multiline replacement
    multiline_pattern = r'\$(?:servername|host|server)\s*=\s*[\'"]localhost[\'"].*?new\s*(?:mysqli|PDO)\s*\([^\)]+\)\s*;'
    content = re.sub(multiline_pattern, r"require_once 'connection.php';", content, flags=re.DOTALL)
    
    if content != initial_content:
        with open(file, 'w', encoding='utf-8') as f:
            f.write(content)
        changes_made_files.append(os.path.basename(file))
        
print(f"Fixed {len(changes_made_files)} files.")
for f in changes_made_files:
    print(f)
