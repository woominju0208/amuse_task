# 프로젝트 이름 : 미니프로젝트 매니저

Vue + Laravel을 이용한 미니 프로젝트 관리 웹페이지

---

## 프로젝트 개요

이 프로젝트는 [기술 스택]를 활용하여 [무엇]을 구현한 것입니다.  
사용자는 [주요 기능 요약].

예시:
- Vue3 + Laravel 10 기반 미니 프로젝트 관리 웹
- 회원가입, 로그인, 로그아웃, 프로젝트/테스크, 사용자 관리 기능 구현

---

## 🛠️ 기술 스택

- Frontend: Vue 3 + Vite 
- Backend: Laravel 10 + Sanctum
- DB: MariaDB
- 기타: Axios, Vue Router, Vuex

---

## 📌 주요 기능

| 기능         | 설명                                 |
|--------------|----------------------------------------|
| 회원가입/로그인/로그아웃 | JWT 인증 기반 사용자 인증 구현             |
| 프로젝트 관리   | 프로젝트 생성/수정/삭제 기능               |
| 테스크 관리     | 프로젝트별 테스크 생성  |
| 사용자 관리     | 사이트 사용자 정리 및 진행중인 프로젝트 출력 |

---

## 💾 설치 방법

```bash
# 백엔드 설치
cd backend
composer install
php artisan migrate
php artisan serve

# 프론트엔드 설치
cd frontend
npm install
npm run dev