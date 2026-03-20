# Spec: Hybrid Search and Course-Centric Review Flow

## 1. Overview
Currently, the application is teacher-centric. Courses only appear in search results if they are already associated with at least one teacher. This spec introduces a hybrid search (autocomplete) and dedicated Course pages to allow users to find any course and review teachers within them, even if no prior association exists.

## 2. Goals
- Make all courses searchable regardless of teacher association.
- Implement a hybrid autocomplete search for Courses and Teachers.
- Create dedicated Course detail pages (`courses.show`).
- Enable automatic linking between Teachers and Courses during the review process.

## 3. Technical Design

### 3.1. Database & Models
- **Course Model**: Add `teachers()` relationship (BelongsToMany) and a `search` scope.
- **Teacher Model**: Improve `scopeSearch` to be more performant for hybrid queries.

### 3.2. Backend Components
- **SearchController**: New API controller with a `search` method returning JSON:
  ```json
  {
    "courses": [{"id": 1, "code": "ABC", "name": "Course Name"}],
    "teachers": [{"id": 1, "name": "Teacher Name", "avg_quality": 4.5}]
  }
  ```
- **CourseController**: 
    - `show(Course $course)`: Displays the course page.
    - Logic to list teachers associated with the course and their specific stats for that course.
- **ReviewService**: Update `createReview` to ensure `course_teacher` record exists (automatic linking).

### 3.3. Frontend Components
- **Navigation/Search Bar**: Replace static search with an Alpine.js-powered autocomplete component.
- **Course Show View (`resources/views/courses/show.blade.php`)**:
    - List of teachers for the course.
    - "Rate a Teacher" button leading to a teacher selection/search.
- **Teacher Show View**: Keep existing rating form but ensure it works within the new navigation context.

## 4. User Flows

### Flow A: Searching for a Course
1. User types "Renewable" in the search bar.
2. Autocomplete shows "Seminario de Energías Renovables" under "Materias".
3. User clicks the course.
4. User lands on `/courses/45`.
5. Page shows "No reviews yet. Rate your teacher".
6. User clicks "Rate teacher" -> Selects/Searches for "Pérez" -> Fills review.
7. System saves review and links Pérez to course 45.

### Flow B: Searching for a Teacher
1. User types "Pérez".
2. Autocomplete shows "Dr. Pérez" under "Profesores".
3. User clicks teacher.
4. User lands on `/teachers/1` (existing flow).

## 5. Security & Validation
- Institutional email requirement for reviews remains.
- Standard Laravel CSRF protection for all search and review actions.
- Rate limiting on the search API.

## 6. Success Criteria
- Searching for "Seminario de Energías Renovables" returns the course.
- Submitting a review for a teacher in a new course successfully links them.
- Autocomplete feels fast and responsive (< 300ms).
