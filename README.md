# Projet Architecture d'Application

## Compétences acquises

Dans le cadre de ce projet, nous avons conçu l'architecture technique de Puzzix, un réseau social ludique où les utilisateurs doivent identifier une image originale à partir d'une version fortement déformée par des filtres et des effets.

Conception d'une Architecture Micro-services
Nous avons appris à découper une application complexe en services distincts et spécialisés pour optimiser les performances et la maintenance. Notre architecture repose sur la collaboration de plusieurs serveurs aux rôles définis :

Alice (Frontend) gère l'interface utilisateur et la création des séquences de retouches via un système de glisser-déposer.

Bill (Backend) orchestre l'ensemble de l'application et stocke les séquences d'opérations.

Claire est dédiée au stockage massif des images originales.

Diego et Elise sont des unités de calcul spécialisées respectivement dans les filtres (modifications colorimétriques) et les effets (déplacement de pixels).

## Gestion de la Charge et Scalabilité (Load Balancing)

Un point clé de notre apprentissage a été la gestion de la charge serveur ("High Availability"). Nous avons conçu les serveurs de traitement (Diego et Elise) pour qu'ils soient clonables à l'infini car ils ne possèdent pas d'état (stateless) et n'ont pas de stockage associé. Nous avons développé une logique côté backend (Bill) capable de référencer ces multiples clones et de répartir les demandes de transformation de manière équilibrée lors des pics de fréquentation.

## Orchestration et Design d'API

Nous avons défini les protocoles de communication entre ces différents services. Cela a impliqué la rédaction d'une documentation technique précise détaillant la nomenclature des APIs (méthodes, URL, entrées/sorties). Nous avons également implémenté la logique d'orchestration permettant au serveur principal de reconstruire une image finale en appelant successivement les différents services de transformation selon l'ordre défini par l'utilisateur.
