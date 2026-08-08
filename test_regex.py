import re
import os
import glob

files = glob.glob(r"c:\xampp\htdocs\yum\*.php")
count = 0
missed_files = []

for file in files:
    if file.endswith('connection.php') or file.endswith('fix_db.py') or file.endswith('test_regex.py'):
        continue
        
    with open(file, 'r', encoding='utf-8', errors='ignore') as f:
        content = f.read()
        
    if "localhost" not in content:
        continue

    # Match inline new mysqli
    inline_pattern = r'\$conn\s*=\s*new\s*mysqli\s*\(\s*["\']localhost["\']\s*,\s*["\']root["\']\s*,\s*["\']["\']\s*,\s*["\']yum["\']\s*\)'
    
    # Match multiline block
    pattern1 = r'\$(?:servername|host|server)\s*=\s*[\'"]localhost[\'"].*?new\s*(?:mysqli|PDO)\s*\([^\)]+\)\s*;'
    
    found = False
    if re.search(inline_pattern, content):
        found = True
    elif re.search(pattern1, content, re.DOTALL):
        found = True
        
    if found:
        count += 1
    else:
        missed_files.append(os.path.basename(file))
        
print(f"Total files identified: {count}")
print(f"Missed files: {missed_files}")
