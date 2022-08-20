# jstd
JavaScript Techical Debt estimator
https://jstd.ece.uowm.gr/

The dataset of the manuscript "Forecasting Technical Debt in JavaScript Applications" by Ioannis Zozas, Stamatia Bibi, Apostolos Ampatzoglou is in the ZIP file

Metrics included :

1. External Indicators

POPL -> Popularity – Number of stars in github

AGE -> Reverse days to the latest release

OPEN_ISSUES -> Open issues (bugs)

CLOSED_ISSUES -> Closed/resolved issues (bugs)

DEVLP -> Developers/contributors in the project

PART -> Commits for every release.

DOC -> Comments per commit.

UPD -> Frequency of updates (in days between releases)

2. Source Code Size & Complexity Metrics

SLOC -> Physical source code lines

LCOM -> Lines of comments.

LOC -> Total lines of code = SLOC + LCOM.

NOA -> The number of attributes.
	
NOC -> The number of classes.
	
NOM -> The number of methods.
	
FILES -> The number of files.
	
DIRS -> The number of directories.
	
SIZE -> Release size in bytes.
	
PARM -> Number of function parameters (used part of cr tool code).

DIT -> Depth of inheritance tree (used part of cr tool code).

MEM -> Memory heap (as calculated by firefox using about:memory).

CC -> Cyclomatic complexity (used part of cr tool code).

CCDEN -> Cyclomatic complexity density (used part of cr tool code).

HEFF -> Halstead effort (used part of cr and lizard tool code).

HPV -> Halstead program volume (used part of cr and lizard tool code).

HPL -> Halstead program level difficulty (we should note that tokens are also counted but not used as a mteric, rather than used for calculating Halsted metrics)

CLONE -> Duplicate (cloned) lines (based on jscpd source code).

COVRG -> Source code coverage percent (based on jest source code)

Maintainability metrics

OBFS -> Number of obfuscation incidents.

CSMELL -> Total count of code smell issues.

VULN -> Total count of vulnerability issues.
	
JS metrics

WITH -> WITH keyword statements.

EVAL -> EVAL keyword statements.
	
VECMA -> Version of ECMAScript applied. Initially based on the source code of EScheck tool, to detect the latest features of the latest version and then, backwards, detect features assign to each version up to the first.

NEW -> NEW keyword statements.
	
ANONYM -> Number of Anonymous functions. All anonymous functions are detected based in function definition (using () in the code line) when assigning a value.

ARROW -> Number of Arrow functions. Arrow functions are dected based on the special key combination (=>) in JavaScript

TD -> Technical debt principal calculated based on the benchmark of Amanatidis et al. (Amanatidis, T., et al., (2020). Evaluating the agreement among technical debt measurement tools: building an empirical bench-mark of technical debt liabilities. Empir Software Eng 25, 4161–4204.)

