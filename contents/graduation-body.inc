<article class="graduation-page">
    <header class="graduation-header">
        <h1>🏁 Graduation</h1>
        <p class="congrats">
            You have completed the CMSForNerd v3.1 Modernization Curriculum! 
            You have transformed a legacy script into a secure, tested, and standards-compliant PHP 8.4 application.
        </p>
    </header>

    <div class="certificate-container">
        <div class="certificate">
            <div class="cert-border-outer">
                <div class="cert-border-inner">
                    <div class="cert-content">
                        <span class="cert-seal">🎓</span>
                        <h2 class="cert-title">Certificate of Completion</h2>
                        <h3 class="cert-subtitle">PHP 8.4+ & PHP 9 Modernization Mastery</h3>
                        
                        <div class="cert-award">
                            <p>Awarded to:</p>
                            <div class="student-name">[STUDENT_NAME]</div>
                        </div>

                        <p class="cert-text">
                            This certificate verifies that the recipient has successfully completed the 
                            <strong>CMSForNerd v3.1 Laboratory Curriculum</strong>. 
                            The student has demonstrated proficiency in the following modern PHP competencies:
                        </p>

                        <table class="competency-table">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Competency Achieved</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1. Architecture</td>
                                    <td>Mastered PHP 8.4+ Property Hooks & Constructor Promotion.</td>
                                    <td class="status">VERIFIED</td>
                                </tr>
                                <tr>
                                    <td>2. Standards</td>
                                    <td>Achieved 100% PSR-12 Linting via Automated Audits.</td>
                                    <td class="status">VERIFIED</td>
                                </tr>
                                <tr>
                                    <td>3. Security</td>
                                    <td>Implemented Level 2 CSP & Defensive Sanitization.</td>
                                    <td class="status">VERIFIED</td>
                                </tr>
                                <tr>
                                    <td>4. Testing</td>
                                    <td>Developed Unit Tests using PHPUnit 11 (AAA Pattern).</td>
                                    <td class="status">VERIFIED</td>
                                </tr>
                                <tr>
                                    <td>5. Quality</td>
                                    <td>Generated Visual HTML Coverage Reports (>90%).</td>
                                    <td class="status">VERIFIED</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="endorsement">
                            <p>"The recipient has proven they can take legacy systems and transform them into secure, scalable, and standards-compliant modern applications without losing the core philosophy of simplicity."</p>
                        </div>

                        <div class="signatures">
                            <div class="signature">
                                <div class="sig-line"></div>
                                <p>Harisfazillah Jamel</p>
                                <span>Lead Developer, CMSForNerd</span>
                            </div>
                            <div class="signature">
                                <div class="sig-line"></div>
                                <p>Gemini AI</p>
                                <span>Thought Partner & Auditor</span>
                            </div>
                        </div>

                        <div class="footer-meta">
                            <p>Date: <?php echo date('F j, Y'); ?></p>
                            <p class="digital-sig">Digital Signature: SHA-256: <?php echo hash('sha256', date('Y-m-d') . 'Graduation'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="next-steps">
        <h2>🛠️ Professional Application</h2>
        <p>Congratulations to you and your students! Completing this curriculum is a major milestone in mastering modern backend engineering.</p>
        <div class="instruction-box">
            <h3>How to issue this for your students:</h3>
            <ul>
                <li><strong>Dynamic Names:</strong> You can modify <code>contents/graduation-body.inc</code> to accept a <code>$studentName</code> variable.</li>
                <li><strong>Print Ready:</strong> Use the browser's print function (Ctrl+P) to save this as a PDF certificate.</li>
                <li><strong>Digital Verification:</strong> The SHA-256 signature above is unique to the date of graduation.</li>
            </ul>
        </div>
    </section>
</article>

<style>
.graduation-page { max-width: 1000px; margin: 0 auto; font-family: 'Inter', system-ui, sans-serif; }
.graduation-header { text-align: center; margin-bottom: 3rem; }
.graduation-header h1 { font-size: 3rem; color: #1a1a1a; margin-bottom: 1rem; }
.graduation-header .congrats { font-size: 1.25rem; color: #4b5563; max-width: 700px; margin: 0 auto; }

.certificate-container { perspective: 1000px; margin-bottom: 4rem; }
.certificate { background: #fff; padding: 2rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border-radius: 0.5rem; transition: transform 0.3s ease; }
.cert-border-outer { border: 15px double #1a1a1a; padding: 10px; }
.cert-border-inner { border: 2px solid #1a1a1a; padding: 2.5rem; }
.cert-content { text-align: center; position: relative; }
.cert-seal { font-size: 4rem; display: block; margin-bottom: 1rem; }
.cert-title { font-family: 'Playfair Display', serif; font-size: 3.5rem; color: #1a1a1a; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 2px; }
.cert-subtitle { font-size: 1.75rem; color: #6b7280; margin-bottom: 2.5rem; font-style: italic; }

.cert-award { margin-bottom: 2.5rem; }
.cert-award p { font-size: 1.125rem; color: #4b5563; margin-bottom: 0.5rem; }
.student-name { font-family: 'Dancing Script', cursive; font-size: 3rem; color: #1a1a1a; border-bottom: 2px solid #e5e7eb; display: inline-block; padding: 0 4rem; clear: both; }

.cert-text { font-size: 1.125rem; color: #374151; max-width: 800px; margin: 0 auto 2.5rem auto; line-height: 1.6; }

.competency-table { width: 100%; margin-bottom: 3rem; border-collapse: collapse; text-align: left; }
.competency-table th { background: #f9fafb; padding: 0.75rem 1rem; font-weight: 600; color: #111827; border-bottom: 2px solid #e5e7eb; }
.competency-table td { padding: 0.75rem 1rem; color: #4b5563; border-bottom: 1px solid #f3f4f6; }
.competency-table .status { font-weight: 700; color: #059669; text-align: center; }

.endorsement { font-style: italic; color: #6b7280; max-width: 700px; margin: 0 auto 3rem auto; line-height: 1.5; font-size: 1rem; }

.signatures { display: flex; justify-content: space-around; margin-bottom: 3rem; }
.signature { text-align: center; width: 250px; }
.sig-line { border-top: 2px solid #1a1a1a; margin-bottom: 0.5rem; }
.signature p { font-weight: 600; margin-bottom: 0.25rem; color: #111827; }
.signature span { font-size: 0.875rem; color: #6b7280; }

.footer-meta { font-size: 0.875rem; color: #9ca3af; text-align: left; border-top: 1px solid #f3f4f6; padding-top: 1rem; }
.digital-sig { font-family: monospace; font-size: 0.75rem; margin-top: 0.25rem; }

.next-steps { background: #f3f4f6; padding: 2rem; border-radius: 0.5rem; margin-top: 2rem; }
.next-steps h2 { color: #111827; margin-top: 0; }
.instruction-box { background: #fff; padding: 1.5rem; border-radius: 0.375rem; border-left: 4px solid #3b82f6; }
.instruction-box h3 { margin-top: 0; color: #1d4ed8; }
.instruction-box ul { padding-left: 1.5rem; margin-bottom: 0; }
.instruction-box li { margin-bottom: 0.5rem; }

@media print {
    body * { visibility: hidden; }
    .certificate-container, .certificate-container * { visibility: visible; }
    .certificate-container { position: absolute; left: 0; top: 0; width: 100%; }
    .certificate { box-shadow: none; padding: 0; }
    .next-steps, .graduation-header { display: none; }
}
</style>

<!-- Load fonts for the certificate -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

