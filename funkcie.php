<?php                  

function validateMenuType(string $type): bool
{
    $menuTypes = [
        'header',
        'footer',
    ];
        return in_array($type, $menuTypes);
}
function getMenuData(string $type): array
{
    $menu = [];
    if (validateMenuType($type)) {
        if ($type == "header") {
            $menu = [
                'home' => [
                    'name' => 'Domov',
                    'path' => 'index.php',
                ],
                'portfolio' => [
                    'name' => 'Portfólio',
                    'path' => 'portfolio.php',
                ],
                'qna' => [
                    'name' => 'Q&A',
                    'path' => 'qna.php',
                ],
                'kontakt' => [
                    'name' => 'Kontakt',
                    'path' => 'kontakt.php',
                ]
            ];
        } elseif ($type == "footer") {
            $menu = [
                'home' => [
                    'name' => 'Domov',
                    'path' => 'index.php',
                ],
                'qna' => [
                    'name' => 'Q&A',
                    'path' => 'qna.php',
                ],
                'kontakt' => [
                    'name' => 'Kontakt',
                    'path' => 'kontakt.php',
                ]
            ];
        }
    }
    return $menu;
}

function printMenu(array $menu)
{
    foreach ($menu as $menuName => $menuData) {
        echo '<li><a href="'.$menuData['path'].'">'.$menuData['name'].'</a></li>';
    }
}





function loadPortfolioData($filePath) // funkcia na načítanie portfólia
{
    if (!file_exists($filePath)) {
        return [];
    }
    $jsonData = file_get_contents($filePath); // načítanie json 
    $data = json_decode($jsonData, true);
    if ($data == null) {
        return [];
    }
    return $data;
}

function getPortfolioItems($data)
{
    return $data['portfolioItems'] ?? [];
}

function generatePortfolio($portfolioItems) {
    $html = '<section class="container">';
    $html .= '<div class="row">';
    if (!empty($portfolioItems)) {
        foreach ($portfolioItems as $index => $item) {
            $html .= '<div class="col-25 portfolio text-white text-center" id="portfolio-' . ($index + 1) . '">';
            $html .= '<a href="' . htmlspecialchars($item['url']) . '" target="_blank" class="portfolio-link">';
            $html .= '<h3>' . htmlspecialchars($item['title']) . '</h3>';
            $html .= '</a>';
            $html .= '</div>';
        }
    } else {
        $html .= '<p class="text-white">Žiadne portfólio</p>';
    }
    $html .= '</div>';
    $html .= '</section>';
    return $html;
}
function getBannerText($data)
{
    return $data['bannerText'] ?? 'Portfólio'; //ternárny operátor - podmienka v 1 riadku
}

?>