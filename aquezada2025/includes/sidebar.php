<aside id="sidebar">
    <div class="sidebar-brand">
        <span class="sidebar-logo">⚙</span>
        <div>
            <p class="sidebar-title">Panel Admin</p>
            <p class="sidebar-sub">Allan Quezada</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="/aquezada2025/admin/panel/g_biografia.php" class="nav-item">
            <span class="nav-icon">👤</span> Biografía
        </a>
        <a href="/aquezada2025/admin/panel/g_habilidades.php" class="nav-item">
            <span class="nav-icon">⚡</span> Habilidades
        </a>
        <a href="/aquezada2025/admin/panel/g_tecnologia.php" class="nav-item">
            <span class="nav-icon">💻</span> Tecnologías
        </a>
        <a href="/aquezada2025/admin/panel/g_proyectos.php" class="nav-item">
            <span class="nav-icon">📁</span> Proyectos
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="/aquezada2025/index.php" class="nav-item nav-item-secondary">
            <span class="nav-icon">🏠</span> Ir al Sitio
        </a>
        <a href="/aquezada2025/admin/autch/logout.php" class="nav-item nav-item-danger">
            <span class="nav-icon">🚪</span> Cerrar Sesión
        </a>
    </div>
</aside>

<style>
/* ══════════════════════════════════════════════════════
   SIDEBAR — FIJO EN PANTALLA
══════════════════════════════════════════════════════ */
#sidebar {
    width:            260px;
    min-width:        260px;
    background-color: #111827;
    border-right:     1px solid #1f2937;
    min-height:       100vh;
    height:           100vh;
    position:         sticky;
    top:              0;
    display:          flex;
    flex-direction:   column;
    flex-shrink:      0;
    overflow-y:       auto;
}

/* ── Marca / Header ── */
.sidebar-brand {
    display:       flex;
    align-items:   center;
    gap:           12px;
    padding:       24px 20px;
    border-bottom: 1px solid #1f2937;
}

.sidebar-logo {
    width:           38px;
    height:          38px;
    background:      rgba(233, 30, 99, 0.15);
    border:          1px solid rgba(233, 30, 99, 0.4);
    border-radius:   8px;
    display:         flex;
    align-items:     center;
    justify-content: center;
    font-size:       1.1rem;
    flex-shrink:     0;
}

.sidebar-title {
    color:       #e91e63;
    font-size:   1rem;
    font-weight: 700;
    margin:      0;
    line-height: 1.2;
}

.sidebar-sub {
    color:     #4b5a72;
    font-size: 0.75rem;
    margin:    0;
}

/* ── Navegación ── */
.sidebar-nav {
    flex-grow: 1;
    padding:   16px 12px;
}

.nav-item {
    display:         flex;
    align-items:     center;
    gap:             10px;
    padding:         10px 14px;
    border-radius:   8px;
    color:           #8892b0;
    text-decoration: none;
    font-size:       0.92rem;
    font-weight:     500;
    transition:      background-color 0.2s ease, color 0.2s ease;
    margin-bottom:   4px;
    cursor:          pointer;
}

.nav-item:hover {
    background-color: rgba(233, 30, 99, 0.1);
    color:            #ffffff;
}

.nav-item.active {
    background-color: rgba(233, 30, 99, 0.15);
    color:            #e91e63;
    font-weight:      600;
}

.nav-icon { font-size: 1rem; }

/* ── Footer del sidebar ── */
.sidebar-footer {
    padding:    12px;
    border-top: 1px solid #1f2937;
}

.nav-item-secondary { color: #6b7a99; }
.nav-item-secondary:hover { color: #ffffff; background-color: rgba(255,255,255,0.05); }

.nav-item-danger { color: #e91e63 !important; }
.nav-item-danger:hover { background-color: rgba(233, 30, 99, 0.1); color: #ff4081 !important; }

/* ── Responsive ── */
@media (max-width: 768px) {
    #sidebar {
        width:    100%;
        height:   auto;
        position: relative;
        flex-direction: row;
        flex-wrap: wrap;
        border-right:   none;
        border-bottom:  1px solid #1f2937;
    }

    .sidebar-brand  { border-bottom: none; padding: 16px; }
    .sidebar-nav    { display: flex; flex-wrap: wrap; gap: 4px; padding: 8px; }
    .sidebar-footer { display: flex; gap: 4px; padding: 8px; border-top: none; }
}
</style>
<script>
    // Marca automáticamente el link activo según la URL actual
    document.querySelectorAll('.nav-item').forEach(function(link) {
        if (link.href && window.location.href.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });
</script>