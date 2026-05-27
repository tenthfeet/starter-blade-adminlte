---
name: js-conventions
description: Guidelines and file structure for working with frontend JavaScript files in this project.
---

# JavaScript Conventions Skill

Activate this skill whenever you are reading, writing, refactoring, or reviewing frontend JavaScript files in this project.

## File Structure Template

Every JavaScript file (located in `resources/js/`) should follow this exact 6-section structure, with clear comments separating each block:

```javascript
// ==========================================
// 1. IMPORTS & DEPENDENCIES
// ==========================================
import axios from "axios";
import Swal from "sweetalert2";
// ... other imports

// ==========================================
// 2. CONSTANTS & CONFIGURATION
// ==========================================
const API_TIMEOUT = 5000;
// ... immutable settings/variables

// ==========================================
// 3. STATE & DOM REFERENCES
// ==========================================
const $userForm = $('#user-form');
const $addUserBtn = $('#add-user');
// ... other DOM references and state tracking variables

// ==========================================
// 4. INITIALIZATION
// ==========================================
const usersTable = new DataTable('#users', { ... });
// ... other initializations that run immediately on page load

// ==========================================
// 5. EVENT BINDINGS
// ==========================================
$addUserBtn.on('click', handleAddUserClick);
// ... event listeners using named handler functions only

// ==========================================
// 6. FUNCTIONS & EVENT HANDLERS
// ==========================================
function handleAddUserClick() {
    // ... logic
}
```

---

## Strict Implementation Rules

### 1. No Inline Event Handlers
Never use anonymous inline functions as event handlers unless they are absolutely trivial and inline-scoped (like mapping/formatting functions inside library configs). For DOM elements and listener bindings, always declare a separate named handler function:
* ❌ **Bad:**
  ```javascript
  $btn.on('click', function() {
      // 20 lines of logic here
  });
  ```
*  **Good:**
  ```javascript
  $btn.on('click', handleButtonClick);

  function handleButtonClick() {
      // 20 lines of logic here
  }
  ```

### 2. Clean Unused and Incorrect Imports
Ensure all imported dependencies are utilized. Avoid dead imports:
* Do not import classes like `Axios` (capital A) unless you explicitly instantiate it as `new Axios()`. Use the default `axios` instance for standard operations.
* Remove unused library imports to keep bundle sizes minimal.

### 3. Clear Variable Declarations
* Always use `const` for immutable variables and DOM/jQuery reference caching.
* Use `let` for mutable state variables. Avoid the use of `var`.
