<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [
            [['_route' => 'default', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null],
            [['_route' => 'index', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null],
        ],
        '/test' => [[['_route' => 'test', '_controller' => 'App\\Controller\\DefaultController::test'], null, null, null, false, false, null]],
        '/preference' => [[['_route' => 'preference', '_controller' => 'App\\Controller\\DefaultController::preference'], null, ['GET' => 0], null, false, false, null]],
        '/e/a/f' => [[['_route' => 'e_a_f_index', '_controller' => 'App\\Controller\\EAFController::index'], null, ['GET' => 0], null, true, false, null]],
        '/e/a/f/new' => [[['_route' => 'e_a_f_new', '_controller' => 'App\\Controller\\EAFController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/eAF/elements/binaryEvaluation' => [[['_route' => 'binaireEvaluation', '_controller' => 'App\\Controller\\EAFElementsController::beEvaluation'], null, ['GET' => 0], null, false, false, null]],
        '/eAF/elements/tonewb' => [[['_route' => 'to_newb', '_controller' => 'App\\Controller\\EAFElementsController::tonewb'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/eAF/elements/addnewb' => [[['_route' => 'addnewb', '_controller' => 'App\\Controller\\EAFElementsController::addnew'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/eAF/elements/addnewmap' => [[['_route' => 'addnewmap', '_controller' => 'App\\Controller\\EAFElementsController::addnewmap'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/entreprise' => [[['_route' => 'entreprise_index', '_controller' => 'App\\Controller\\EntrepriseController::index'], null, ['GET' => 0], null, true, false, null]],
        '/entreprise/new' => [[['_route' => 'entreprise_new', '_controller' => 'App\\Controller\\EntrepriseController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/evaluateur' => [[['_route' => 'profile', '_controller' => 'App\\Controller\\EvaluateurController::index'], null, null, null, true, false, null]],
        '/evaluateur/critere' => [[['_route' => 'critere', '_controller' => 'App\\Controller\\EvaluateurController::critere'], null, null, null, false, false, null]],
        '/evaluateur/critereCreate' => [[['_route' => 'critereCreate', '_controller' => 'App\\Controller\\EvaluateurController::critereCreate'], null, ['POST' => 0], null, false, false, null]],
        '/evaluation/elements' => [[['_route' => 'evaluation_elements_index', '_controller' => 'App\\Controller\\EvaluationElementsController::index'], null, ['GET' => 0], null, true, false, null]],
        '/evaluation/elements/new' => [[['_route' => 'evaluation_elements_new', '_controller' => 'App\\Controller\\EvaluationElementsController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/expert' => [[['_route' => 'expert', '_controller' => 'App\\Controller\\ExpertController::index'], null, null, null, true, false, null]],
        '/expert/update' => [[['_route' => 'update_ev', '_controller' => 'App\\Controller\\ExpertController::update'], null, ['POST' => 0], null, false, false, null]],
        '/expert/alternative_elemennt' => [[['_route' => 'alternative_element', '_controller' => 'App\\Controller\\ExpertController::alternative_element'], null, null, null, false, false, null]],
        '/manager' => [[['_route' => 'manager', '_controller' => 'App\\Controller\\ManagerController::index'], null, null, null, true, false, null]],
        '/manager/generate_evaluateures' => [[['_route' => 'generate_evaluateures', '_controller' => 'App\\Controller\\ManagerController::generate_evaluateures'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/manager/generate_experts' => [[['_route' => 'generate_experts', '_controller' => 'App\\Controller\\ManagerController::generate_experts'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/manager/alternative' => [[['_route' => 'alternative', '_controller' => 'App\\Controller\\ManagerController::alternative'], null, null, null, false, false, null]],
        '/manager/alternative_create' => [[['_route' => 'alternative_create', '_controller' => 'App\\Controller\\ManagerController::alternative_create'], null, ['POST' => 0], null, false, false, null]],
        '/manager/preferences' => [[['_route' => 'manager_prefernces', '_controller' => 'App\\Controller\\ManagerController::preferences'], null, null, null, false, false, null]],
        '/manager/binary_preferences' => [[['_route' => 'manager_binary_prefernces', '_controller' => 'App\\Controller\\ManagerController::binary_preferences'], null, null, null, false, false, null]],
        '/preferences' => [[['_route' => 'preferences_index', '_controller' => 'App\\Controller\\PreferencesController::index'], null, ['GET' => 0], null, true, false, null]],
        '/preferences/new' => [[['_route' => 'preferences_new', '_controller' => 'App\\Controller\\PreferencesController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/user' => [[['_route' => 'user_index', '_controller' => 'App\\Controller\\UserController::index'], null, ['GET' => 0], null, true, false, null]],
        '/user/new' => [[['_route' => 'user_new', '_controller' => 'App\\Controller\\UserController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/login' => [[['_route' => 'fos_user_security_login', '_controller' => 'fos_user.security.controller:loginAction'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/login_check' => [[['_route' => 'fos_user_security_check', '_controller' => 'fos_user.security.controller:checkAction'], null, ['POST' => 0], null, false, false, null]],
        '/logout' => [[['_route' => 'fos_user_security_logout', '_controller' => 'fos_user.security.controller:logoutAction'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/comments(?'
                    .'|/([^/]++)/([^/]++)/([^/]++)/([^/]++)/([^/]++)(*:226)'
                    .'|B/([^/]++)/([^/]++)/([^/]++)/([^/]++)/([^/]++)(*:280)'
                .')'
                .'|/getValues(?'
                    .'|/([^/]++)/([^/]++)/([^/]++)/([^/]++)(*:338)'
                    .'|B(?'
                        .'|/([^/]++)/([^/]++)/([^/]++)/([^/]++)(*:386)'
                        .'|yUser/([^/]++)/([^/]++)/([^/]++)/([^/]++)(*:435)'
                        .'|byUser/([^/]++)/([^/]++)/([^/]++)/([^/]++)/([^/]++)(*:494)'
                    .')'
                .')'
                .'|/e(?'
                    .'|/a/f/([^/]++)(?'
                        .'|(*:525)'
                        .'|/edit(*:538)'
                        .'|(*:546)'
                    .')'
                    .'|AF/elements/(?'
                        .'|jsonget1/([^/]++)(*:587)'
                        .'|evalget1/([^/]++)(*:612)'
                        .'|hil/([^/]++)(*:632)'
                    .')'
                    .'|ntreprise/([^/]++)(?'
                        .'|(*:662)'
                        .'|/edit(*:675)'
                        .'|(*:683)'
                    .')'
                    .'|valuat(?'
                        .'|eur/(?'
                            .'|delete/([^/]++)(*:723)'
                            .'|validation/([^/]++)(*:750)'
                        .')'
                        .'|ion/elements/(?'
                            .'|([^/]++)(?'
                                .'|(*:786)'
                                .'|/edit(*:799)'
                                .'|(*:807)'
                            .')'
                            .'|tonew(*:821)'
                            .'|jsonget(?'
                                .'|/([^/]++)(*:848)'
                                .'|All(?'
                                    .'|/([^/]++)(*:871)'
                                    .'|B(?'
                                        .'|/([^/]++)(*:892)'
                                        .'|yUser/([^/]++)(*:914)'
                                        .'|byUser/([^/]++)/([^/]++)(*:946)'
                                    .')'
                                .')'
                            .')'
                            .'|evalget/([^/]++)(*:973)'
                        .')'
                    .')'
                .')'
                .'|/manager/(?'
                    .'|jsonget(?'
                        .'|/([^/]++)(*:1015)'
                        .'|2/([^/]++)(*:1034)'
                    .')'
                    .'|validate/([^/]++)(*:1061)'
                    .'|e(?'
                        .'|tape/([^/]++)(*:1087)'
                        .'|xpert/erase/([^/]++)(*:1116)'
                        .'|valuateur/erase/([^/]++)(*:1149)'
                    .')'
                    .'|alternative/([^/]++)(*:1179)'
                    .'|toNextStep/([^/]++)(*:1207)'
                .')'
                .'|/preferences/([^/]++)(?'
                    .'|(*:1241)'
                    .'|/edit(*:1255)'
                    .'|(*:1264)'
                .')'
                .'|/user/([^/]++)(?'
                    .'|(*:1291)'
                    .'|/edit(*:1305)'
                    .'|(*:1314)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        226 => [[['_route' => 'comment_meth', '_controller' => 'App\\Controller\\DefaultController::comments'], ['id1', 'id2', 'value', 'type', 'entr'], null, null, false, true, null]],
        280 => [[['_route' => 'commentsB', '_controller' => 'App\\Controller\\DefaultController::commentsB'], ['id1', 'id2', 'value', 'type', 'cr'], null, null, false, true, null]],
        338 => [[['_route' => 'getValues', '_controller' => 'App\\Controller\\DefaultController::getValues'], ['ent', 'id1', 'id2', 'type'], null, null, false, true, null]],
        386 => [[['_route' => 'getValuesB', '_controller' => 'App\\Controller\\DefaultController::getValuesB'], ['cr', 'id1', 'id2', 'type'], null, null, false, true, null]],
        435 => [[['_route' => 'getValuesByUser', '_controller' => 'App\\Controller\\DefaultController::getValuesByUser'], ['us', 'id1', 'id2', 'type'], null, null, false, true, null]],
        494 => [[['_route' => 'getValuesBbyUser', '_controller' => 'App\\Controller\\DefaultController::getValuesBbyUser'], ['us', 'id1', 'id2', 'type', 'criteria'], null, null, false, true, null]],
        525 => [[['_route' => 'e_a_f_show', '_controller' => 'App\\Controller\\EAFController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        538 => [[['_route' => 'e_a_f_edit', '_controller' => 'App\\Controller\\EAFController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        546 => [[['_route' => 'e_a_f_delete', '_controller' => 'App\\Controller\\EAFController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        587 => [[['_route' => 'jsonget1', '_controller' => 'App\\Controller\\EAFElementsController::jsonget1'], ['id'], null, null, false, true, null]],
        612 => [[['_route' => 'evalget1', '_controller' => 'App\\Controller\\EAFElementsController::evalget1'], ['id'], null, null, false, true, null]],
        632 => [[['_route' => 'hil', '_controller' => 'App\\Controller\\EAFElementsController::evalget8'], ['id'], null, null, false, true, null]],
        662 => [[['_route' => 'entreprise_show', '_controller' => 'App\\Controller\\EntrepriseController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        675 => [[['_route' => 'entreprise_edit', '_controller' => 'App\\Controller\\EntrepriseController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        683 => [[['_route' => 'entreprise_delete', '_controller' => 'App\\Controller\\EntrepriseController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        723 => [[['_route' => 'myEvalDelete', '_controller' => 'App\\Controller\\EvaluateurController::delete'], ['id'], ['GET' => 0], null, false, true, null]],
        750 => [[['_route' => 'validation', '_controller' => 'App\\Controller\\EvaluateurController::jsonget'], ['id'], null, null, false, true, null]],
        786 => [[['_route' => 'evaluation_elements_show', '_controller' => 'App\\Controller\\EvaluationElementsController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        799 => [[['_route' => 'evaluation_elements_edit', '_controller' => 'App\\Controller\\EvaluationElementsController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        807 => [[['_route' => 'evaluation_elements_delete', '_controller' => 'App\\Controller\\EvaluationElementsController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        821 => [[['_route' => 'to_new', '_controller' => 'App\\Controller\\EvaluationElementsController::tonew'], [], ['POST' => 0], null, false, false, null]],
        848 => [[['_route' => 'jsongetjsonget', '_controller' => 'App\\Controller\\EvaluationElementsController::jsonget'], ['id'], null, null, false, true, null]],
        871 => [[['_route' => 'jsongetAll', '_controller' => 'App\\Controller\\EvaluationElementsController::jsongetAll'], ['id'], null, null, false, true, null]],
        892 => [[['_route' => 'jsongetAllB', '_controller' => 'App\\Controller\\EvaluationElementsController::jsongetAllB'], ['id'], null, null, false, true, null]],
        914 => [[['_route' => 'jsongetAllByUser', '_controller' => 'App\\Controller\\EvaluationElementsController::jsongetAllByUser'], ['id'], null, null, false, true, null]],
        946 => [[['_route' => 'jsongetAllBbyUser', '_controller' => 'App\\Controller\\EvaluationElementsController::jsongetAllBbyUser'], ['id', 'ev'], null, null, false, true, null]],
        973 => [[['_route' => 'evalget', '_controller' => 'App\\Controller\\EvaluationElementsController::evalget'], ['id'], null, null, false, true, null]],
        1015 => [[['_route' => 'jsonget', '_controller' => 'App\\Controller\\ManagerController::jsonget'], ['id'], null, null, false, true, null]],
        1034 => [[['_route' => 'jsonget2', '_controller' => 'App\\Controller\\ManagerController::jsonget2'], ['id'], null, null, false, true, null]],
        1061 => [[['_route' => 'validate', '_controller' => 'App\\Controller\\ManagerController::validate'], ['id'], null, null, false, true, null]],
        1087 => [[['_route' => 'etape', '_controller' => 'App\\Controller\\ManagerController::etape'], ['id'], null, null, false, true, null]],
        1116 => [[['_route' => 'delete_experts', '_controller' => 'App\\Controller\\ManagerController::delete_experts'], ['id'], ['GET' => 0], null, false, true, null]],
        1149 => [[['_route' => 'delete_evaluateur', '_controller' => 'App\\Controller\\ManagerController::delete_evaluateur'], ['id'], ['GET' => 0], null, false, true, null]],
        1179 => [[['_route' => 'alternative_delete', '_controller' => 'App\\Controller\\ManagerController::delete'], ['id'], ['GET' => 0], null, false, true, null]],
        1207 => [[['_route' => 'toNextStep', '_controller' => 'App\\Controller\\ManagerController::toNextStep'], ['id'], ['POST' => 0], null, false, true, null]],
        1241 => [[['_route' => 'preferences_show', '_controller' => 'App\\Controller\\PreferencesController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1255 => [[['_route' => 'preferences_edit', '_controller' => 'App\\Controller\\PreferencesController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1264 => [[['_route' => 'preferences_delete', '_controller' => 'App\\Controller\\PreferencesController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        1291 => [[['_route' => 'user_show', '_controller' => 'App\\Controller\\UserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1305 => [[['_route' => 'user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1314 => [
            [['_route' => 'user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
