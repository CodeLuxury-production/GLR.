<?php 
include 'header.php';
include 'charter_content.php';
?>

<div class="content-section">
    <div class="two-column">
        <!-- Левое меню для навигации по уставу -->
        <div class="sidebar">
            <h2 class="sidebar-title">Разделы Устава</h2>
            <div class="sidebar-separator"></div>
            <div class="sidebar-menu charter-menu">
                <?php foreach ($charter_sections as $key => $title): ?>
                    <div class="menu-item" data-section="<?php echo $key; ?>">
                        <?php echo $title; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Основное содержание устава -->
        <div class="content-area">
            <div class="charter-content-area">
                <h1 style="text-align: center; color: #ffd700; margin-bottom: 3rem; font-size: 2.5rem;">
                    УСТАВ ВЕЛИКОЙ АРМИИ РЕСПУБЛИКИ
                </h1>
                
                <?php foreach ($charter_sections as $key => $title): ?>
                    <section class="charter-section" id="<?php echo $key; ?>">
                        <h2><?php echo $title; ?></h2>
                        <div class="charter-content">
                            <?php 
                            if (isset($charter_content[$key])) {
                                echo $charter_content[$key];
                            }
                            ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация меню устава
    initCharterMenu();
    
    // Активация пункта меню при скролле
    initScrollSpy();
});

function initCharterMenu() {
    const menuItems = document.querySelectorAll('.charter-menu .menu-item');
    const sections = document.querySelectorAll('.charter-section');
    
    if (menuItems.length > 0) {
        menuItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section');
                const targetSection = document.getElementById(sectionId);
                
                if (targetSection) {
                    // Плавная прокрутка к разделу
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Обновление активного пункта меню
                    updateActiveMenuItem(sectionId);
                }
            });
        });
        
        // Активируем первый пункт меню по умолчанию
        if (menuItems[0]) {
            menuItems[0].classList.add('active');
        }
    }
}

function initScrollSpy() {
    const sections = document.querySelectorAll('.charter-section');
    const menuItems = document.querySelectorAll('.charter-menu .menu-item');
    
    // Функция для определения видимой секции
    function getCurrentSection() {
        let currentSection = '';
        const scrollPosition = window.scrollY + 150;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });
        
        if (!currentSection && sections.length > 0) {
            const lastSection = sections[sections.length - 1];
            if (scrollPosition >= lastSection.offsetTop) {
                currentSection = lastSection.getAttribute('id');
            }
        }
        
        return currentSection;
    }
    
    // Обновление активного пункта меню
    function updateActiveMenu() {
        const currentSection = getCurrentSection();
        if (currentSection) {
            updateActiveMenuItem(currentSection);
        }
    }
    
    window.addEventListener('scroll', updateActiveMenu);
    updateActiveMenu();
}

function updateActiveMenuItem(sectionId) {
    const menuItems = document.querySelectorAll('.charter-menu .menu-item');
    
    menuItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('data-section') === sectionId) {
            item.classList.add('active');
            
            const menu = document.querySelector('.charter-menu');
            const itemTop = item.offsetTop;
            const menuHeight = menu.clientHeight;
            const itemHeight = item.clientHeight;
            
            menu.scrollTo({
                top: itemTop - (menuHeight / 2) + (itemHeight / 2),
                behavior: 'smooth'
            });
        }
    });
}
</script>

<style>
.charter-content-area {
    padding-right: 1rem;
}

/* Стили для скроллбара контента */
.charter-content-area::-webkit-scrollbar {
    width: 8px;
}

.charter-content-area::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.charter-content-area::-webkit-scrollbar-thumb {
    background: #ffd700;
    border-radius: 4px;
}

.charter-content-area::-webkit-scrollbar-thumb:hover {
    background: #ffed4e;
}

/* Стили для разделов устава */
.charter-section {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    padding: 2rem;
    margin-bottom: 2rem;
    border-left: 4px solid #ffd700;
    transition: all 0.3s ease;
}

.charter-section:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateX(5px);
}

.charter-section h2 {
    color: #ffd700;
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
    border-bottom: 2px solid rgba(255, 215, 0, 0.3);
    padding-bottom: 0.5rem;
}

.charter-content p {
    line-height: 1.7;
    margin-bottom: 1rem;
    text-align: justify;
}

.charter-content ul {
    margin-left: 2rem;
    margin-bottom: 1.5rem;
}

.charter-content li {
    margin-bottom: 0.8rem;
    line-height: 1.6;
    position: relative;
}

.charter-content ul li::before {
    content: '•';
    color: #ffd700;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}

.charter-content ol li::before {
    content: none;
}

/* ИСПРАВЛЕННОЕ ФИКСИРОВАННОЕ МЕНЮ */
.sidebar {
    position: sticky;
    top: 120px;
    background: rgba(26, 26, 46, 0.95);
    border-radius: 10px;
    padding: 1.5rem;
    height: fit-content;
    max-height: calc(100vh - 120px); /* Уменьшили отступ */
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 215, 0, 0.2);
    z-index: 100;
    overflow: hidden;
}

/* Заголовок и разделитель */
.sidebar-title {
    color: #ffd700;
    margin-bottom: 1rem;
    font-size: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.sidebar-separator {
    height: 3px;
    background: #ff0000;
    margin-bottom: 1rem; /* Уменьшили отступ */
    width: 80px;
    border-radius: 2px;
    display: block;
}

/* МЕНЮ - УБИРАЕМ ФИКСИРОВАННУЮ ВЫСОТУ И ДОБАВЛЯЕМ АВТОМАТИЧЕСКУЮ */
.charter-menu {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    max-height: calc(100vh - 220px); /* Автоматическая высота */
    overflow-y: auto;
    padding-right: 5px;
    margin-top: 0;
}

/* Уменьшаем отступы у пунктов меню для компактности */
.charter-menu .menu-item {
    padding: 0.8rem 1rem; /* Уменьшили padding */
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    margin-bottom: 0;
    font-size: 0.85rem; /* Немного уменьшили шрифт */
    text-align: left;
    position: relative;
    line-height: 1.3; /* Улучшили межстрочный интервал */
}

.charter-menu .menu-item:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateX(5px);
}

.charter-menu .menu-item.active {
    background: rgba(255, 215, 0, 0.2);
    border-color: #ffd700;
    color: #ffd700;
    transform: translateX(10px);
}

.charter-menu .menu-item.active::before {
    content: '';
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 70%;
    background: #ffd700;
    border-radius: 2px;
}

/* Скроллбар для меню устава */
.charter-menu::-webkit-scrollbar {
    width: 6px;
}

.charter-menu::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 3px;
}

.charter-menu::-webkit-scrollbar-thumb {
    background: rgba(255, 215, 0, 0.5);
    border-radius: 3px;
}

.charter-menu::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 215, 0, 0.7);
}

/* Адаптивность для мобильных устройств */
@media (max-width: 768px) {
    .two-column {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .sidebar {
        position: sticky;
        top: 80px;
        max-height: none;
        background: rgba(10, 10, 10, 0.95);
        padding: 1rem;
        z-index: 99;
    }
    
    .sidebar-separator {
        width: 60px;
        margin-bottom: 0.8rem;
    }
    
    .charter-menu {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
        max-height: none;
        overflow-y: visible;
    }
    
    .charter-menu .menu-item {
        flex: 1;
        min-width: 140px;
        text-align: center;
        font-size: 0.8rem;
        padding: 0.6rem 0.5rem;
    }
    
    .charter-menu .menu-item.active::before {
        display: none;
    }
    
    .charter-content-area {
        padding-right: 0;
    }
    
    .sidebar-title {
        font-size: 1.3rem;
    }
}

/* Анимация для плавного появления */
@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.charter-section {
    animation: slideInFromLeft 0.5s ease-out;
}

/* Общий layout */
.two-column {
    display: grid;
    grid-template-columns: 300px 1fr; /* Немного уменьшили ширину sidebar */
    gap: 2rem;
    align-items: start;
}

.content-area {
    min-height: 100vh;
}

/* Плавная прокрутка */
html {
    scroll-behavior: smooth;
}

/* Улучшаем видимость активного элемента */
.charter-menu .menu-item.active {
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
}

/* Эффект при скролле для шапки */
.header.scrolled ~ main .sidebar {
    top: 80px;
}

/* Дополнительная оптимизация для длинного меню */
@media (min-height: 800px) {
    .charter-menu {
        max-height: calc(100vh - 200px);
    }
}

@media (min-height: 1000px) {
    .charter-menu {
        max-height: calc(100vh - 180px);
    }
}

/* Убедимся что все пункты видны */
.charter-menu {
    min-height: 200px; /* Минимальная высота */
}
</style>

<?php include 'footer.php'; ?>