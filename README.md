# 📄 Submission Instructions  
## Laravel Application – ValueSERP Integration & CSV Export  

---

## 🔹 Project Overview  

This project is a **Laravel-based web application** that integrates with the **ValueSERP API**.  
It allows users to search multiple keywords, view aggregated search results, and export the results in CSV format.

---

## 🔹 Features Implemented  

- ✅ Multi-keyword search using a single input field (comma-separated)  
- ✅ Maximum 5 search keywords validation  
- ✅ Integration with ValueSERP Search API  
- ✅ Display of search results with pagination  
- ✅ CSV export of all search results  
- ✅ User-friendly interface using Bootstrap  
- ✅ Proper input validation and error handling  
- ✅ Session-based result handling (no database required)  

---

## 🔹 Technology Stack  

- **Framework:** Laravel  
- **Frontend:** Blade + Bootstrap 5  
- **API Integration:** ValueSERP API  
- **Export:** CSV using Laravel Excel  
- **Language:** PHP  

---

## 🔹 Setup Instructions  

### 1️⃣ Clone the repository  

```bash
git clone https://github.com/lokeshv2w/valueserp-laravel-Tasks.git
```
### 2️⃣ Navigate to the project directory

```bash
cd valueserp-laravel-Tasks
```
 
### 3️⃣ Install dependencies

```bash
composer install
```

### 4️⃣ Create environment file

```bash
cp .env.example .env
```

### 5️⃣ Add ValueSERP API key in .env

```bash
VALUESERP_API_KEY=your_api_key_here
```

### 6️⃣ Generate application key

```bash
php artisan key:generate
```

### 7️⃣ Run the application

```bash
php artisan serve
```

### 8️⃣ Open in browser

```bash
http://127.0.0.1:8000
```

## 🔹 How to Use the Application

### 1️⃣ Enter search keywords separated by commas

```bash
PHP, Laravel, REST API, MySQL
```

### 2️⃣ Click on Search
### 3️⃣ View results with pagination
### 4️⃣ Click Download CSV to export all results


---

## 🔹 Validation & Error Handling  

- ⚠️ Only up to 5 keywords are allowed
- ⚠️ Empty or invalid input is not accepted 
- ⚠️ API errors are handled gracefully  
- ⚠️ Previous input is retained on validation errors 
- ⚠️ CSV export is disabled if no data is available
---

## 🔹 Notes 

- Search results are based on Google SERP data provided by ValueSERP
- Snippets may be truncated as per search engine behavior
- CSV export contains raw data only (no styling, as CSV does not support formatting)
---

## 🔹 Repository Link 

### 👉 GitHub Repository:

```bash
https://github.com/lokeshv2w/valueserp-laravel-Tasks
```