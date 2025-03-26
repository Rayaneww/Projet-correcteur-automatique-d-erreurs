Dans ce projet, on a réalisé une page web en HTML et PHP permettant de jouer à « Qui est-ce ? ». Le but est d’identifier une personne parmi plusieurs images à partir de 7 questions auxquelles on répond par oui ou non.
Fonctionnement :

On récupère les réponses de l’utilisateur sous forme de 0 ou 1 (non ou oui).

Ces 7 réponses forment un code binaire de 7 bits.

À l’aide de trois masques (masques1, masques2 et masques3), on calcule trois syndromes en faisant un XOR entre les bits correspondants.

Ces syndromes permettent de savoir s’il y a une erreur dans une réponse et de localiser la question sur laquelle l’erreur a été faite.

Si un mensonge ou une erreur est détecté, on corrige automatiquement le bit fautif en inversant sa valeur (0 devient 1 ou 1 devient 0).

Ensuite, on recherche dans une liste d’images celle qui correspond au code corrigé.

L’image trouvée est affichée avec un cadre rouge pour la mettre en évidence.

Un message indique également sur quelle question l’erreur a été détectée, ou précise s’il n’y a pas de mensonge ou qu’il y a plusieurs erreurs.

Ce système permet donc de corriger automatiquement une erreur et de toujours proposer une réponse fiable à l’utilisateur.
