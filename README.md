# Usage on Windows

Create the following Run config in Fleet

```
{
    "configurations": [
        {
            "type": "command",
            "name": "rector",
            "program": "$PROJECT_DIR$\\vendor\\bin\\rector.bat",
            "args": ["process", "src", "--dry-run"],
        }
    ]
}
```
