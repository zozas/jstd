# jstd
JavaScript Techical Debt estimator
https://jstd.ece.uowm.gr/

The dataset of the manuscript "Forecasting Technical Debt in JavaScript Applications" by Ioannis Zozas, Stamatia Bibi, Apostolos Ampatzoglou is in the ZIP file.

Metrics included in the study :

1. External Indicators

1.1 POPL referring to Popularity. Calculated as the number of stars in github.

1.2 AGE referring to the Age of the project, calculated as the reverse days to the latest release.

1.3 OPEN_ISSUES referring to the open issues (bugs) as reported by the github platform.

1.4 CLOSED_ISSUES referring to the Closed/resolved issues (bugs) as reported by the github platform.

1.5 DEVLP referring to the number of Developers/contributors in the project.

1.6 PART referring to the participation, calculated as the number of commits for every release.

1.7 DOC referring to the documentation, calculated as the number of comments per commit.

1.8 UPD referring to the update level, calculated as the frequency of updates (measured in days between releases).

2. Source Code Size & Complexity Metrics

2.1 SLOC referring to the physical source code lines.

2.2 LCOM referring to the lines of comments (not to be mistaken with the CK suite LCOM metric!).

2.3 LOC referring to the total lines of code, calculated as the sum of SLOC and LCOM.

2.4 NOA referring to the number of attributes (calculated based on the cr tool code).
	
2.5 NOC referring to the total number of classes (as described in the JavaScript latest specification).
	
2.6 NOM referring  to the number of methods.
	
2.7 FILES referring to the total number of files.
	
2.8 DIRS referring to the total number of directories.
	
2.9 SIZE referring to the release's size in bytes.
	
2.10 PARM referring to the number of function parameters (used part of cr tool code).

2.11 DIT referring to the depth of inheritance tree (used part of cr tool code).

2.12 MEM referring to the memory heap allocated at run time (as calculated by firefox using about:memory).

2.13 CC referring to Cyclomatic complexity (used part of cr tool code).

2.14 CCDEN referring to Cyclomatic complexity density (used part of cr tool code).

2.15 HEFF referring to Halstead effort (used part of cr and lizard tool code).

2.16 HPV referring to Halstead program volume (used part of cr and lizard tool code).

2.17 HPL referring to Halstead program level difficulty (we should note that tokens are also counted but not used as a mteric, rather than used for calculating Halsted metrics)

2.18 CLONE referring to duplicate (cloned) lines (based on jscpd source code).

2.19 COVRG referring to source code coverage percent (based on jest source code)

3. Maintainability metrics

3.1 OBFS referring to the number of obfuscation incidents in the source code (easily detected due to the encoding characters / and #).

3.2 CSMELL referring to the total count of code smell issues (based on the SonarQube deifinitions).

3.3 VULN referring to the total count of vulnerability issues (based on the SonarQube definitions).
	
4. JavaScript metrics

4.1 WITH referring to the total number of WITH keyword statements detected.

4.2 EVAL referring to the total number of EVAL keyword statements detected.
	
4.3 VECMA referring to the version of ECMAScript applied. Initially based on the source code of EScheck tool, to detect the latest features of the latest version and then, backwards, detect features assign to each version up to the first.

4.4 NEW referring to the total number of NEW keyword statements detected.
	
4.5 ANONYM referring to the total number of Anonymous functions detected. All anonymous functions are detected based in function definition (using () in the code line) when assigning a value.

4.6 ARROW referring to the total number of Arrow functions detected. Arrow functions are dected based on the special key combination (=>) in JavaScript

4.7 TD referring to Technical debt principal calculated based on the benchmark of Amanatidis et al. (Amanatidis, T., et al., (2020). Evaluating the agreement among technical debt measurement tools: building an empirical bench-mark of technical debt liabilities. Empir Software Eng 25, 4161–4204.)

