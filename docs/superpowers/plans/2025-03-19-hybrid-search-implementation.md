# Hybrid Search and Course-Centric Review Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Implement a hybrid autocomplete search for courses and teachers, dedicated course pages, and automatic linking during reviews.

**Architecture:** 
- **API Search:** New `SearchController` returns JSON for autocomplete.
- **Course Detail:** New `CourseController` and view for individual course information and teacher lists.
- **Data Integrity:** `ReviewService` handles automatic pivot table population.
- **Frontend:** Alpine.js component for the search bar dropdown.

**Tech Stack:** Laravel 13, Tailwind CSS 4, Alpine.js, MySQL.

---

### Task 1: Backend Model & Service Updates

**Files:**
- Modify: `app/Models/Course.php` (Add teachers relationship and search scope)
- Modify: `app/Models/Teacher.php` (Improve search scope)
- Create: `app/Services/CourseService.php`
- Modify: `app/Services/ReviewService.php` (Auto-link logic)

- [ ] **Step 1: Update Course Model**
  Add `teachers()` relationship and `scopeSearch`.
- [ ] **Step 2: Update Teacher Model**
  Refine `scopeSearch` for better hybrid results.
- [ ] **Step 3: Create CourseService**
  Implement `getCourseWithTeachers(Course $course)` and `searchCourses(string $term)`.
- [ ] **Step 4: Update ReviewService**
  In `createReview`, add: `$teacher->courses()->syncWithoutDetaching([$data['course_id']]);`.
- [ ] **Step 5: Commit**
  `git commit -m "feat: update models and services for course-centric flow"`

---

### Task 2: API Search Controller

**Files:**
- Create: `app/Http/Controllers/Api/SearchController.php`
- Modify: `routes/web.php` (Add API route)

- [ ] **Step 1: Create SearchController**
  Implement `index(Request $request)` returning JSON with `courses` and `teachers`.
- [ ] **Step 2: Add Route**
  `Route::get('/api/search', [SearchController::class, 'index'])->name('api.search');`
- [ ] **Step 3: Test API**
  Verify `curl http://localhost/api/search?q=renovables` returns the correct JSON.
- [ ] **Step 4: Commit**
  `git commit -m "feat: add hybrid search API endpoint"`

---

### Task 3: Course Controller and View

**Files:**
- Create: `app/Http/Controllers/CourseController.php`
- Create: `resources/views/courses/show.blade.php`
- Modify: `routes/web.php` (Add course route)

- [ ] **Step 1: Create CourseController**
  Implement `show(Course $course)`.
- [ ] **Step 2: Create Course View**
  Design the layout for course details and teacher list.
- [ ] **Step 3: Add Route**
  `Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');`
- [ ] **Step 4: Commit**
  `git commit -m "feat: add dedicated course detail page"`

---

### Task 4: Frontend Autocomplete Component

**Files:**
- Modify: `resources/views/layouts/app.blade.php` (or navigation component)
- Create: `resources/views/components/search-autocomplete.blade.php`

- [ ] **Step 1: Create Autocomplete Component**
  Implement Alpine.js logic for fetch, dropdown visibility, and keyboard navigation.
- [ ] **Step 2: Integrate into Navigation**
  Replace existing search bar with `<x-search-autocomplete />`.
- [ ] **Step 3: Commit**
  `git commit -m "feat: implement frontend autocomplete search component"`

---

### Task 5: Validation & Final Polish

- [ ] **Step 1: Verify Flow A**
  Search Course -> View Course -> Rate Teacher -> Check Link.
- [ ] **Step 2: Verify Flow B**
  Search Teacher -> View Teacher -> Existing Flow.
- [ ] **Step 3: Run Tests**
  `php artisan test`
- [ ] **Step 4: Commit**
  `git commit -m "test: verify hybrid search and review linking"`
