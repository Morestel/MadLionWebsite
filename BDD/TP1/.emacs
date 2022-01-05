;; desactive message de depart
(setq inhibit-startup-message t)

;; Affiche le numero de ligne et de colonne
(setq line-number-mode t)
(line-number-mode t)

;; Active la coloration syntaxique
(global-font-lock-mode t)

;; Affiche la parenthese correspondante
(show-paren-mode)

;; Mode par defaut pour edition de texte qui indente les lignes.
(setq default-major-mode 'indented-text-mode)

;; Pour les accents
(standard-display-european 1)

;; Surline la ligne du curseur
;;(global-hl-line-mode 1)

;; Pour la roulette de la souris
(mouse-wheel-mode t)

;; Change les couleurs
(cond (window-system
       (set-foreground-color "wheat")
       (set-background-color "DarkSlateGray")
       (set-cursor-color "MediumOrchid")
       (set-mouse-color "MediumOrchid")
       (set-face-foreground 'menu "wheat")
       (set-face-background 'menu "DarkSlateGray")
       (set-face-background 'fringe "DarkSlateGray")
       (set-face-foreground 'region "white")
       (set-face-background 'region "SteelBlue")))
       (set-face-background 'tool-bar "DarkSlateGray")


;;============================;;
;;     Insertion de blocs     ;;
;;============================;;


;; Bloc if simple
;;
;; if () {
;; }
;;
(defun start-if-block()
	(interactive)
	(insert "\nif () {\n\n}\n")
	(backward-char 7)
)
(global-set-key [f1] 'start-if-block)


;; Bloc if else
;;
;; if () {
;; }else{
;; }
;;
(defun start-if-else-block()
	(interactive)
	(insert "\nif () {\n\n}else{\n\n}\n")
	(backward-char 15)
)
(global-set-key [f2] 'start-if-else-block)


;; Bloc for
;;
;; for (;;) {
;; }
;;
(defun start-for-block()
	(interactive)
	(insert "\nfor (;;) {\n\n}\n")
	(backward-char 9)
)
(global-set-key [f3] 'start-for-block)


;; Bloc while
;;
;; while () {
;; }
;;
(defun start-while-block()
	(interactive)
	(insert "\nwhile () {\n\n}\n")
	(backward-char 7)
)
(global-set-key [f4] 'start-while-block)


;; Entete doxygen
;;
;; /*!
;;   \fn
;;   \param 
;;   \brief 
;;   \return
;; */
(defun insert-function-header ()
  (interactive)
  (insert "/*!\n")
  (insert "   \\fn \n")
  (insert "   \\param \n")
  (insert "   \\return \n")
  (insert "*/\n"))
(global-set-key [f11] 'insert-function-header)


;; Entete de fichier
;;
;; /*********************************************/
;; /**                                         **
;;  *                                           *
;;  * Author: Cedric Royer-Bertrand             *
;;  *                                           *
;;  **                                         **/
;; /*********************************************/
(defun insert-file-header ()
  (interactive)
  (insert "/*********************************************/\n")
  (insert "/**                                         **\n")
  (insert " *                                           *\n")
  (insert " * Author: Cedric Royer-Bertrand             *\n")
  (insert " *                                           *\n")
  (insert " **                                         **/\n")
  (insert "/*********************************************/\n"))
(global-set-key [f12] 'insert-file-header)
