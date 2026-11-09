/**
 * Vel Pharmacy College CMS - Interactive Client Controller
 * Manages Tab Routing, Dynamic Modals, AJAX CRUD, Multi-Page Content Saving,
 * Media Uploads, and Dedicated SEO / GEO / AEO & Traffic Intelligence Hub.
 */

document.addEventListener('DOMContentLoaded', () => {
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  // -------------------------------------------------------------
  // 1. TAB ROUTING ENGINE
  // -------------------------------------------------------------
  const navLinks = document.querySelectorAll('.cms-nav-link[data-tab]');
  const tabContents = document.querySelectorAll('.cms-tab-content');
  const pageTitle = document.getElementById('cmsPageTitle');

  function switchTab(tabId) {
    navLinks.forEach(link => {
      const active = link.getAttribute('data-tab') === tabId;
      link.classList.toggle('active', active);
      if (active && pageTitle) {
        pageTitle.textContent = link.getAttribute('data-title') || 'CMS Dashboard';
      }
    });

    tabContents.forEach(tab => {
      tab.classList.toggle('active', tab.id === 'tab-' + tabId);
    });

    window.location.hash = tabId;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const tabId = link.getAttribute('data-tab');
      switchTab(tabId);
    });
  });

  // Handle URL hash on load
  const initialHash = window.location.hash.replace('#', '');
  if (initialHash && document.getElementById('tab-' + initialHash)) {
    switchTab(initialHash);
  } else {
    switchTab('overview');
  }

  // Mobile Sidebar Toggle
  const sidebar = document.getElementById('cmsSidebar');
  const toggleBtn = document.getElementById('cmsSidebarToggle');
  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('open');
    });
  }

  // -------------------------------------------------------------
  // 2. TOAST NOTIFICATION ENGINE
  // -------------------------------------------------------------
  const toast = document.getElementById('cmsToast');
  const toastMsg = document.getElementById('cmsToastMsg');

  function showToast(message, type = 'success') {
    if (!toast || !toastMsg) return;
    toastMsg.textContent = message;
    toast.style.borderLeftColor = type === 'success' ? '#10B981' : (type === 'danger' ? '#EF4444' : '#F59E0B');
    toast.classList.add('show');
    setTimeout(() => {
      toast.classList.remove('show');
    }, 4000);
  }
  window.showToast = showToast;

  // -------------------------------------------------------------
  // 3. FACULTY DIRECTORY CRUD & MODAL
  // -------------------------------------------------------------
  const facultyModal = document.getElementById('facultyModal');
  const facultyForm = document.getElementById('facultyForm');
  const addFacultyBtn = document.getElementById('addFacultyBtn');
  const closeFacultyModal = document.getElementById('closeFacultyModal');
  const cancelFacultyModal = document.getElementById('cancelFacultyModal');
  const facultySearchInput = document.getElementById('facultySearchInput');

  if (addFacultyBtn && facultyModal && facultyForm) {
    addFacultyBtn.addEventListener('click', () => {
      facultyForm.reset();
      document.getElementById('facultyFormId').value = '';
      document.getElementById('facultyModalTitle').textContent = 'Add New Faculty Member';
      document.getElementById('facultyImgPreview').src = 'assets/images/Faculty/Dr. G. Saravanan.png';
      facultyModal.classList.add('open');
    });
  }

  [closeFacultyModal, cancelFacultyModal].forEach(btn => {
    if (btn && facultyModal) {
      btn.addEventListener('click', () => facultyModal.classList.remove('open'));
    }
  });

  // Edit Faculty button delegation
  document.addEventListener('click', (e) => {
    const editBtn = e.target.closest('.edit-faculty-btn');
    if (editBtn && facultyModal && facultyForm) {
      const data = JSON.parse(editBtn.getAttribute('data-faculty'));
      document.getElementById('facultyFormId').value = data.id || '';
      document.getElementById('facultyFormSno').value = data.sno || '1';
      document.getElementById('facultyFormName').value = data.name || '';
      document.getElementById('facultyFormQual').value = data.qualification || '';
      document.getElementById('facultyFormDesig').value = data.designation || '';
      document.getElementById('facultyFormDept').value = data.department || '';
      document.getElementById('facultyFormDeptSlug').value = data.dept_slug || 'chemistry';
      document.getElementById('facultyFormExp').value = data.experience || '';
      document.getElementById('facultyFormBadge').value = data.badge || '';
      document.getElementById('facultyFormCadre').value = data.cadre || '';
      document.getElementById('facultyFormEmail').value = data.email || '';
      document.getElementById('facultyFormOffice').value = data.office || '';
      document.getElementById('facultyFormImage').value = data.image || '';
      document.getElementById('facultyFormDoctorate').checked = !!data.is_doctorate;
      document.getElementById('facultyFormFeatured').checked = !!data.featured;
      document.getElementById('facultyFormDesc').value = data.description || '';
      document.getElementById('facultyFormSpecs').value = (data.specializations || []).join('\n');
      document.getElementById('facultyFormSubjects').value = (data.subjects || []).join('\n');
      document.getElementById('facultyFormAchieve').value = (data.achievements || []).join('\n');

      document.getElementById('facultyImgPreview').src = data.image ? '/' + data.image : '/assets/images/Faculty/Dr. G. Saravanan.png';
      document.getElementById('facultyModalTitle').textContent = 'Edit Profile: ' + data.name;
      facultyModal.classList.add('open');
    }
  });

  // Delete Faculty button delegation
  document.addEventListener('click', (e) => {
    const delBtn = e.target.closest('.delete-faculty-btn');
    if (delBtn) {
      const id = delBtn.getAttribute('data-id');
      const name = delBtn.getAttribute('data-name');
      if (confirm(`Are you sure you want to remove ${name} from the collegiate faculty roster?`)) {
        const fd = new FormData();
        fd.append('action', 'delete_faculty');
        fd.append('id', id);
        fd.append('csrf_token', csrfToken);

        fetch('/cms/api.php', { method: 'POST', body: fd })
          .then(r => r.json())
          .then(res => {
            if (res.success) {
              showToast(res.message, 'success');
              delBtn.closest('tr')?.remove();
            } else {
              showToast(res.message, 'danger');
            }
          })
          .catch(() => showToast('Error deleting faculty profile.', 'danger'));
      }
    }
  });

  // Save Faculty Form
  if (facultyForm) {
    facultyForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const fd = new FormData(facultyForm);
      fd.append('action', 'save_faculty');
      fd.append('csrf_token', csrfToken);

      showToast('Saving faculty profile...', 'info');

      fetch('/cms/api.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            facultyModal.classList.remove('open');
            showToast(res.message, 'success');
            setTimeout(() => location.reload(), 800);
          } else {
            showToast(res.message, 'danger');
          }
        })
        .catch(() => showToast('Failed to save faculty.', 'danger'));
    });
  }

  // Live Faculty Search Filter
  if (facultySearchInput) {
    facultySearchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase().trim();
      document.querySelectorAll('#facultiesTable tbody tr').forEach(row => {
        const text = row.getAttribute('data-faculty-row') || '';
        row.style.display = text.includes(q) ? '' : 'none';
      });
    });
  }

  // -------------------------------------------------------------
  // 4. MEDIA LIBRARY & UPLOADS
  // -------------------------------------------------------------
  const mediaDropzone = document.getElementById('mediaDropzone');
  const mediaFileInput = document.getElementById('mediaFileInput');

  if (mediaDropzone && mediaFileInput) {
    mediaDropzone.addEventListener('click', () => mediaFileInput.click());

    ['dragenter', 'dragover'].forEach(name => {
      mediaDropzone.addEventListener(name, (e) => {
        e.preventDefault();
        mediaDropzone.classList.add('dragover');
      });
    });

    ['dragleave', 'drop'].forEach(name => {
      mediaDropzone.addEventListener(name, (e) => {
        e.preventDefault();
        mediaDropzone.classList.remove('dragover');
      });
    });

    mediaDropzone.addEventListener('drop', (e) => {
      const files = e.dataTransfer.files;
      if (files.length > 0) uploadFileToMedia(files[0]);
    });

    mediaFileInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) uploadFileToMedia(e.target.files[0]);
    });

    function uploadFileToMedia(file) {
      const fd = new FormData();
      fd.append('action', 'upload_media');
      fd.append('file', file);
      fd.append('csrf_token', csrfToken);

      showToast('Uploading photo to media library...', 'info');

      fetch('/cms/api.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            showToast(res.message, 'success');
            setTimeout(() => location.reload(), 900);
          } else {
            showToast(res.message, 'danger');
          }
        })
        .catch(() => showToast('Media upload failed.', 'danger'));
    }
  }

  // Faculty Modal Image File Input
  const facultyImgFileInput = document.getElementById('facultyImgFileInput');
  if (facultyImgFileInput) {
    facultyImgFileInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (!file) return;

      const fd = new FormData();
      fd.append('action', 'upload_media');
      fd.append('file', file);
      fd.append('subfolder', 'Faculty');
      fd.append('csrf_token', csrfToken);

      showToast('Uploading faculty portrait...', 'info');

      fetch('/cms/api.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            document.getElementById('facultyFormImage').value = res.filepath;
            document.getElementById('facultyImgPreview').src = '/' + res.filepath;
            showToast('Faculty portrait uploaded & preview updated!', 'success');
          } else {
            showToast(res.message, 'danger');
          }
        })
        .catch(() => showToast('Image upload failed.', 'danger'));
    });
  }

  // -------------------------------------------------------------
  // 4b. MEDIA ASSET LIBRARY SEARCH & COPY PATH CONTROLLER
  // -------------------------------------------------------------
  const mediaTabSearch = document.getElementById('mediaTabSearch');
  const mediaLibraryGrid = document.getElementById('mediaLibraryGrid');
  const mediaTabCount = document.getElementById('mediaTabCount');
  if (mediaTabSearch && mediaLibraryGrid) {
    mediaTabSearch.addEventListener('input', (e) => {
      const q = (e.target.value || '').toLowerCase().trim();
      let visible = 0;
      const items = mediaLibraryGrid.querySelectorAll('.cms-media-item');
      items.forEach(item => {
        const name = item.getAttribute('data-name') || '';
        const match = !q || name.includes(q);
        item.style.display = match ? '' : 'none';
        if (match) visible++;
      });
      if (mediaTabCount) {
        mediaTabCount.textContent = `${visible} Assets Found`;
      }
    });
  }

  // Copy Image Path to Clipboard with visual feedback
  document.addEventListener('click', (e) => {
    const copyBtn = e.target.closest('.copy-path-btn');
    if (copyBtn) {
      const path = copyBtn.getAttribute('data-path');
      navigator.clipboard.writeText(path).then(() => {
        showToast('Image URL copied to clipboard: ' + path, 'success');
        copyBtn.classList.add('copied');
        const span = copyBtn.querySelector('span');
        if (span) {
          const origText = span.textContent;
          span.textContent = '✓ Copied!';
          setTimeout(() => {
            copyBtn.classList.remove('copied');
            span.textContent = origText;
          }, 2000);
        }
      });
    }
  });

  // -------------------------------------------------------------
  // 4c. DYNAMIC CARD BUILDERS: UPCOMING EVENTS & HIGHLIGHTS
  // -------------------------------------------------------------
  function reindexCards(containerId, itemSelector, labelSelector, prefix) {
    const container = document.getElementById(containerId);
    if (!container) return;
    const cards = container.querySelectorAll(itemSelector);
    cards.forEach((card, idx) => {
      const label = card.querySelector(labelSelector);
      if (label) {
        label.textContent = `${prefix} #${idx + 1}`;
      }
    });
  }

  // 1. Add / Remove Home Upcoming Event
  window.addHomeEvent = function() {
    const container = document.getElementById('homeEventsContainer');
    if (!container) return;
    const count = container.querySelectorAll('.cms-event-card').length;
    const nextIdx = count + 1;
    const card = document.createElement('div');
    card.className = 'cms-event-card';
    card.style = 'background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem; animation: modalPopIn 0.25s ease;';
    card.innerHTML = `
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
        <span class="badge-tag cms-event-card-num" style="background: #EEF2FF; color: var(--cms-primary); font-weight: 700;">Upcoming Event #${nextIdx}</span>
        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="removeHomeEvent(this)" style="padding: 0.2rem 0.55rem; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.3rem;" title="Delete this event">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
          <span>Delete</span>
        </button>
      </div>
      <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr; gap: 0.6rem;">
        <div class="cms-form-group">
          <label class="cms-form-label">Event Date</label>
          <input type="date" class="cms-form-control ev-date" value="">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Category Tag</label>
          <input type="text" class="cms-form-control ev-cat" value="" placeholder="e.g. National Symposium">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Color Theme</label>
          <select class="cms-form-control ev-cat-color">
            <option value="blue" selected>Blue</option>
            <option value="amber">Amber</option>
            <option value="maroon">Maroon</option>
            <option value="green">Green</option>
          </select>
        </div>
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Event Headline / Title</label>
        <input type="text" class="cms-form-control ev-title" value="" placeholder="Enter event headline...">
      </div>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem;">
        <div class="cms-form-group">
          <label class="cms-form-label">Time Schedule</label>
          <input type="text" class="cms-form-control ev-time" value="" placeholder="e.g. 09:30 AM – 03:30 PM">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Venue / Hall</label>
          <input type="text" class="cms-form-control ev-venue" value="" placeholder="e.g. Seminar Hall">
        </div>
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Description / Summary</label>
        <textarea class="cms-form-control ev-desc" rows="2" placeholder="Brief event abstract or description..."></textarea>
      </div>
      <div class="cms-form-group" style="margin-bottom: 0;">
        <label class="cms-form-label">Button Target Link</label>
        <input type="text" class="cms-form-control ev-link" value="enquiry">
      </div>
    `;
    container.appendChild(card);
    const titleInput = card.querySelector('.ev-title');
    if (titleInput) titleInput.focus();
    showToast(`Added new Upcoming Event #${nextIdx}`, 'info');
  };

  window.removeHomeEvent = function(btn) {
    const card = btn.closest('.cms-event-card');
    if (card) {
      card.remove();
      reindexCards('homeEventsContainer', '.cms-event-card', '.cms-event-card-num', 'Upcoming Event');
      showToast('Event removed', 'info');
    }
  };

  // 2. Add / Remove Home College Highlight
  window.addHomeHighlight = function() {
    const container = document.getElementById('homeHighlightsContainer');
    if (!container) return;
    const count = container.querySelectorAll('.cms-highlight-card').length;
    const nextIdx = count + 1;
    const uniqueId = 'h_hl_dyn_' + Date.now();
    const card = document.createElement('div');
    card.className = 'cms-highlight-card';
    card.style = 'background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem; animation: modalPopIn 0.25s ease;';
    card.innerHTML = `
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
        <span class="badge-tag cms-hl-card-num" style="background: #FEF3C7; color: #B45309; font-weight: 700;">College Highlight #${nextIdx}</span>
        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="removeHomeHighlight(this)" style="padding: 0.2rem 0.55rem; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.3rem;" title="Delete this highlight">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
          <span>Delete</span>
        </button>
      </div>
      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.6rem;">
        <div class="cms-form-group">
          <label class="cms-form-label">Tag Category</label>
          <input type="text" class="cms-form-control hl-tag" value="" placeholder="e.g. Infrastructure">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Badge Text</label>
          <input type="text" class="cms-form-control hl-badge" value="" placeholder="e.g. State-of-the-Art">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Card Icon</label>
          <select class="cms-form-control hl-icon">
            <option value="shield">🛡️ Shield</option>
            <option value="flask">🧪 Flask / Lab</option>
            <option value="award">🏆 Award</option>
            <option value="users">👥 Students / Faculty</option>
            <option value="hospital">🏥 Hospital / Clinical</option>
            <option value="book">📚 Book / Curriculum</option>
            <option value="star" selected>⭐ Star / Prestige</option>
            <option value="check">✓ Check / Verified</option>
          </select>
        </div>
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Highlight Title</label>
        <input type="text" class="cms-form-control hl-title" value="" placeholder="Enter highlight title...">
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Highlight Photo</label>
        <div class="cms-image-field-wrap">
          <img src="/assets/images/campus-front.jpg" id="${uniqueId}_preview" class="cms-img-thumb" alt="Preview">
          <div style="flex-grow: 1;">
            <div style="display: flex; gap: 0.5rem; align-items: center;">
              <input type="text" id="${uniqueId}" class="cms-form-control cms-img-input hl-img" value="assets/images/campus-front.jpg" oninput="document.getElementById('${uniqueId}_preview').src = this.value ? ('/' + this.value.replace(/^\\//, '')) : '/assets/images/campus-front.jpg';">
              <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm cms-open-media-picker" data-target="${uniqueId}" title="Select from Media Assets">
                📁 Choose
              </button>
              <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm cms-quick-upload-btn" data-target="${uniqueId}" title="Upload Image File">
                ⬆️ Upload
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Description</label>
        <textarea class="cms-form-control hl-desc" rows="2" placeholder="Highlight details and benchmarks..."></textarea>
      </div>
      <div class="cms-form-group" style="margin-bottom: 0;">
        <label class="cms-form-label">Target Link</label>
        <input type="text" class="cms-form-control hl-link" value="about-us">
      </div>
    `;
    container.appendChild(card);
    const titleInput = card.querySelector('.hl-title');
    if (titleInput) titleInput.focus();
    showToast(`Added new College Highlight #${nextIdx}`, 'info');
  };

  window.removeHomeHighlight = function(btn) {
    const card = btn.closest('.cms-highlight-card');
    if (card) {
      card.remove();
      reindexCards('homeHighlightsContainer', '.cms-highlight-card', '.cms-hl-card-num', 'College Highlight');
      showToast('Highlight removed', 'info');
    }
  };

  // 3. Add / Remove Dedicated Highlights Page Item
  window.addHighlightsPageItem = function() {
    const container = document.getElementById('highlightsItemsContainer');
    if (!container) return;
    const count = container.querySelectorAll('.cms-hl-item-card').length;
    const nextIdx = count + 1;
    const uniqueId = 'hl_it_dyn_' + Date.now();
    const itemId = 'hl-custom-' + nextIdx;
    const card = document.createElement('div');
    card.className = 'cms-hl-item-card';
    card.style = 'background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: var(--radius-md); padding: 0.85rem; animation: modalPopIn 0.25s ease;';
    card.innerHTML = `
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
        <span class="badge-tag cms-hl-item-num" style="background: #EEF2FF; color: var(--cms-primary); font-weight: 700;">Item #${nextIdx}</span>
        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="removeHighlightsPageItem(this)" style="padding: 0.2rem 0.55rem; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.3rem;" title="Delete this notice item">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
          <span>Delete</span>
        </button>
      </div>
      <input type="hidden" class="hl-it-id" value="${itemId}">
      <input type="hidden" class="hl-it-slug" value="${itemId}">
      <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 0.5rem;">
        <div class="cms-form-group">
          <label class="cms-form-label">Item #${nextIdx} Title</label>
          <input type="text" class="cms-form-control hl-it-title" value="" placeholder="Notice / Milestone Title...">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Category Filter</label>
          <select class="cms-form-control hl-it-cat">
            <option value="pci">PCI Statutory</option>
            <option value="curriculum">Curriculum</option>
            <option value="infrastructure">Infrastructure</option>
            <option value="concluded">Concluded Event</option>
          </select>
        </div>
      </div>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
        <div class="cms-form-group">
          <label class="cms-form-label">Badge Pill Text</label>
          <input type="text" class="cms-form-control hl-it-badge" value="" placeholder="e.g. Official Gazette 2026">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Circular / Gazette Reference No.</label>
          <input type="text" class="cms-form-control hl-it-ref" value="" placeholder="e.g. Ref: VPC/CIRC/2026/04">
        </div>
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Official Publication Date</label>
        <input type="text" class="cms-form-control hl-it-date" value="${new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}">
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Notice Document / Facility Photo</label>
        <div class="cms-image-field-wrap">
          <img src="/assets/images/campus-front.jpg" id="${uniqueId}_preview" class="cms-img-thumb" alt="Preview">
          <div style="flex-grow: 1;">
            <div style="display: flex; gap: 0.5rem; align-items: center;">
              <input type="text" id="${uniqueId}" class="cms-form-control cms-img-input hl-it-img" value="assets/images/campus-front.jpg" oninput="document.getElementById('${uniqueId}_preview').src = this.value ? ('/' + this.value.replace(/^\\//, '')) : '/assets/images/campus-front.jpg';">
              <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm cms-open-media-picker" data-target="${uniqueId}" title="Select from Media Assets">
                📁 Choose
              </button>
              <button type="button" class="cms-btn cms-btn-secondary cms-btn-sm cms-quick-upload-btn" data-target="${uniqueId}" title="Upload Image File">
                ⬆️ Upload
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="cms-form-group">
        <label class="cms-form-label">Notice Summary</label>
        <textarea class="cms-form-control hl-it-summary" rows="2" placeholder="Summary of notice or event outcome..."></textarea>
      </div>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
        <div class="cms-form-group">
          <label class="cms-form-label">Action Button Label</label>
          <input type="text" class="cms-form-control hl-it-btn-text" value="View Details">
        </div>
        <div class="cms-form-group">
          <label class="cms-form-label">Action Button Link</label>
          <input type="text" class="cms-form-control hl-it-btn-link" value="about-us">
        </div>
      </div>
    `;
    container.appendChild(card);
    const titleInput = card.querySelector('.hl-it-title');
    if (titleInput) titleInput.focus();
    const countSpan = document.getElementById('highlightsItemsCount');
    if (countSpan) countSpan.textContent = container.querySelectorAll('.cms-hl-item-card').length;
    showToast(`Added new Notice / Circular #${nextIdx}`, 'info');
  };

  window.removeHighlightsPageItem = function(btn) {
    const card = btn.closest('.cms-hl-item-card');
    if (card) {
      card.remove();
      reindexCards('highlightsItemsContainer', '.cms-hl-item-card', '.cms-hl-item-num', 'Item');
      const countSpan = document.getElementById('highlightsItemsCount');
      if (countSpan) countSpan.textContent = document.querySelectorAll('#highlightsItemsContainer .cms-hl-item-card').length;
      showToast('Notice item removed', 'info');
    }
  };

  // -------------------------------------------------------------
  // 5. MULTI-PAGE CONTENT SUBNAV & SAVING CONTROLLER
  // -------------------------------------------------------------
  const pageSubnavBtns = document.querySelectorAll('.page-subnav-btn[data-subtab]');
  const subtabPanes = document.querySelectorAll('.cms-subtab-pane');

  function switchPageSubtab(rawKey) {
    if (!rawKey) return;
    let key = rawKey.toString().replace(/^subtab-/, '').replace(/^page-/, '');
    if (key === 'about_us') key = 'about';
    if (key === 'anti_ragging') key = 'antiragging';
    if (key === 'contact_us') key = 'contact';

    const targetSubtabAttr = 'page-' + key;
    const targetPaneId = 'subtab-page-' + key;

    pageSubnavBtns.forEach(btn => {
      btn.classList.toggle('active', btn.getAttribute('data-subtab') === targetSubtabAttr);
    });
    subtabPanes.forEach(pane => {
      pane.classList.toggle('active', pane.id === targetPaneId);
    });
  }

  pageSubnavBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-subtab');
      switchPageSubtab(targetId);
    });
  });

  // Global helper to open page editor directly from Overview cards
  window.openPageEditor = function(pageKey) {
    switchTab('content');
    switchPageSubtab(pageKey);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  // -------------------------------------------------------------
  // 5b. INTERACTIVE MEDIA PICKER & DIRECT IMAGE UPLOADER
  // -------------------------------------------------------------
  const mediaPickerModal = document.getElementById('mediaPickerModal');
  const closeMediaPickerModal = document.getElementById('closeMediaPickerModal');
  const cancelMediaPickerModal = document.getElementById('cancelMediaPickerModal');
  const mediaPickerSearch = document.getElementById('mediaPickerSearch');
  const mediaPickerGrid = document.getElementById('mediaPickerGrid');
  const mediaPickerCount = document.getElementById('mediaPickerCount');
  const mediaPickerTargetLabel = document.getElementById('mediaPickerTargetLabel');
  const mediaPickerUploadBtn = document.getElementById('mediaPickerUploadBtn');
  const cmsQuickFileInput = document.getElementById('cmsQuickFileInput');

  let currentImageTargetId = null;

  function openMediaPicker(targetId) {
    currentImageTargetId = targetId;
    if (mediaPickerTargetLabel) {
      mediaPickerTargetLabel.textContent = targetId;
    }
    if (mediaPickerSearch) {
      mediaPickerSearch.value = '';
      filterMediaPicker('');
    }
    if (mediaPickerModal) {
      mediaPickerModal.classList.add('open');
    }
  }

  function closeMediaPicker() {
    if (mediaPickerModal) {
      mediaPickerModal.classList.remove('open');
    }
  }

  function filterMediaPicker(query) {
    const q = (query || '').toLowerCase().trim();
    let visible = 0;
    const items = mediaPickerGrid?.querySelectorAll('.cms-picker-item') || [];
    items.forEach(item => {
      const name = item.getAttribute('data-name') || '';
      const match = !q || name.includes(q);
      item.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    if (mediaPickerCount) {
      mediaPickerCount.textContent = `${visible} Assets`;
    }
  }

  // Delegated click for Choose / Open Media Picker
  document.addEventListener('click', (e) => {
    const openBtn = e.target.closest('.cms-open-media-picker');
    if (openBtn) {
      const targetId = openBtn.getAttribute('data-target');
      if (targetId) openMediaPicker(targetId);
      return;
    }

    // Direct Quick Upload Button on field
    const quickUploadBtn = e.target.closest('.cms-quick-upload-btn');
    if (quickUploadBtn) {
      currentImageTargetId = quickUploadBtn.getAttribute('data-target');
      if (cmsQuickFileInput) {
        cmsQuickFileInput.value = '';
        cmsQuickFileInput.click();
      }
      return;
    }

    // Media Picker Item Selection
    const pickerItem = e.target.closest('.cms-picker-item');
    if (pickerItem && mediaPickerModal?.classList.contains('open')) {
      const path = pickerItem.getAttribute('data-path');
      if (currentImageTargetId && path) {
        const input = document.getElementById(currentImageTargetId);
        if (input) {
          input.value = path;
          const preview = document.getElementById(currentImageTargetId + '_preview');
          if (preview) {
            preview.src = '/' + path.replace(/^\//, '');
          }
          showToast('Selected image: ' + path, 'success');
        }
      }
      closeMediaPicker();
      return;
    }

    // Backdrop click to close
    if (e.target === mediaPickerModal) {
      closeMediaPicker();
    }
  });

  if (closeMediaPickerModal) closeMediaPickerModal.addEventListener('click', closeMediaPicker);
  if (cancelMediaPickerModal) cancelMediaPickerModal.addEventListener('click', closeMediaPicker);

  if (mediaPickerSearch) {
    mediaPickerSearch.addEventListener('input', (e) => filterMediaPicker(e.target.value));
  }

  if (mediaPickerUploadBtn && cmsQuickFileInput) {
    mediaPickerUploadBtn.addEventListener('click', () => {
      cmsQuickFileInput.value = '';
      cmsQuickFileInput.click();
    });
  }

  if (cmsQuickFileInput) {
    cmsQuickFileInput.addEventListener('change', (e) => {
      const file = e.target.files?.[0];
      if (!file) return;

      const fd = new FormData();
      fd.append('action', 'upload_media');
      fd.append('file', file);
      fd.append('subfolder', 'cms');
      fd.append('csrf_token', csrfToken);

      showToast('Uploading image to media library...', 'info');

      fetch('/cms/api.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
          if (res.success && res.filepath) {
            if (currentImageTargetId) {
              const input = document.getElementById(currentImageTargetId);
              if (input) {
                input.value = res.filepath;
                const preview = document.getElementById(currentImageTargetId + '_preview');
                if (preview) {
                  preview.src = '/' + res.filepath.replace(/^\//, '');
                }
              }
            }
            closeMediaPicker();
            showToast('Image uploaded and set successfully!', 'success');
          } else {
            showToast(res.message || 'Upload failed.', 'danger');
          }
        })
        .catch(() => showToast('Image upload failed.', 'danger'));
    });
  }

  // -------------------------------------------------------------
  // 5c. 100% COMPLETE MULTI-PAGE SERIALIZATION & SAVE HANDLER
  // -------------------------------------------------------------
  window.savePageContent = function(pageKey) {
    const val = (id) => document.getElementById(id)?.value?.trim() || '';
    let payload = {};

    if (pageKey === 'global') {
      payload = {
        general_settings: {
          college_name: val('gs_college_name'),
          logo_img: val('gs_logo_img'),
          preloader_video: val('gs_preloader_video'),
          contact_phone: val('gs_phone_primary'),
          contact_email: val('gs_email_admissions'),
          admissions_cta_url: val('gs_header_cta_url'),
          admissions_cta_text: val('gs_header_cta_text'),
          toll_free: val('gs_toll_free'),
          short_address: val('gs_address_short'),
          naac_badge: val('gs_badge_naac'),
          pci_badge: val('gs_badge_pci'),
          copyright: val('gs_copyright_text'),
          footer_about: val('gs_footer_about')
        },
        general_contact: {
          phone_primary: val('gs_phone_primary'),
          phone_secondary: val('gs_phone_secondary'),
          email_primary: val('gs_email_primary'),
          email_admissions: val('gs_email_admissions'),
          address_full: val('gs_address_full'),
          social_links: {
            facebook: val('gs_social_fb'),
            instagram: val('gs_social_ig'),
            youtube: val('gs_social_yt'),
            linkedin: val('gs_social_li'),
            twitter: val('gs_social_tw')
          }
        }
      };
    } else if (pageKey === 'home') {
      const pillars = [];
      for (let i = 0; i < 4; i++) {
        pillars.push({
          title: val(`h_pillar_${i}_title`),
          desc: val(`h_pillar_${i}_desc`),
          image: val(`h_pillar_${i}_img`)
        });
      }

      const facilities = [];
      for (let i = 0; i < 6; i++) {
        facilities.push({
          tag: val(`h_fac_${i}_tag`),
          title: val(`h_fac_${i}_title`),
          desc: val(`h_fac_${i}_desc`),
          image: val(`h_fac_${i}_img`)
        });
      }

      const whyChoose = [];
      for (let i = 0; i < 4; i++) {
        whyChoose.push({
          title: val(`h_why_${i}_title`),
          desc: val(`h_why_${i}_desc`)
        });
      }

      const faqs = [];
      for (let i = 0; i < 5; i++) {
        faqs.push({
          question: val(`h_faq_${i}_q`),
          answer: val(`h_faq_${i}_a`)
        });
      }

      const monthNames = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
      const eventsList = [];
      const eventCards = document.querySelectorAll('#homeEventsContainer .cms-event-card');
      if (eventCards.length > 0) {
        eventCards.forEach((card, idx) => {
          const rawDate = card.querySelector('.ev-date')?.value?.trim() || val(`h_ev_${idx}_date`);
          let evMonth = '', evDay = '', evYear = '';
          if (rawDate) {
            const parts = rawDate.split('-');
            if (parts.length === 3) {
              evYear = parts[0];
              const mIdx = parseInt(parts[1], 10) - 1;
              evMonth = (mIdx >= 0 && mIdx < 12) ? monthNames[mIdx] : '';
              evDay = String(parseInt(parts[2], 10) || parts[2]);
            }
          }
          eventsList.push({
            date: rawDate,
            month: evMonth,
            day: evDay,
            year: evYear,
            category: card.querySelector('.ev-cat')?.value?.trim() || val(`h_ev_${idx}_cat`),
            category_color: card.querySelector('.ev-cat-color')?.value || val(`h_ev_${idx}_cat_color`) || 'blue',
            title: card.querySelector('.ev-title')?.value?.trim() || val(`h_ev_${idx}_title`),
            time: card.querySelector('.ev-time')?.value?.trim() || val(`h_ev_${idx}_time`),
            venue: card.querySelector('.ev-venue')?.value?.trim() || val(`h_ev_${idx}_venue`),
            description: card.querySelector('.ev-desc')?.value?.trim() || val(`h_ev_${idx}_desc`),
            link: card.querySelector('.ev-link')?.value?.trim() || val(`h_ev_${idx}_link`) || 'enquiry'
          });
        });
      } else {
        for (let i = 0; i < 8; i++) {
          const rawDate = val(`h_ev_${i}_date`);
          let evMonth = '', evDay = '', evYear = '';
          if (rawDate) {
            const parts = rawDate.split('-');
            if (parts.length === 3) {
              evYear = parts[0];
              const mIdx = parseInt(parts[1], 10) - 1;
              evMonth = (mIdx >= 0 && mIdx < 12) ? monthNames[mIdx] : '';
              evDay = String(parseInt(parts[2], 10) || parts[2]);
            }
          }
          eventsList.push({
            date: rawDate,
            month: evMonth,
            day: evDay,
            year: evYear,
            category: val(`h_ev_${i}_cat`),
            category_color: val(`h_ev_${i}_cat_color`) || 'blue',
            title: val(`h_ev_${i}_title`),
            time: val(`h_ev_${i}_time`),
            venue: val(`h_ev_${i}_venue`),
            description: val(`h_ev_${i}_desc`),
            link: val(`h_ev_${i}_link`) || 'enquiry'
          });
        }
      }

      const defaultIcons = ['shield', 'flask', 'award', 'users'];
      const highlightsList = [];
      const highlightCards = document.querySelectorAll('#homeHighlightsContainer .cms-highlight-card');
      if (highlightCards.length > 0) {
        highlightCards.forEach((card, idx) => {
          const imgInput = card.querySelector('.cms-img-input') || card.querySelector('.hl-img') || document.getElementById(`h_hl_${idx}_img`);
          highlightsList.push({
            icon: card.querySelector('.hl-icon')?.value || defaultIcons[idx] || 'star',
            tag: card.querySelector('.hl-tag')?.value?.trim() || val(`h_hl_${idx}_tag`),
            badge: card.querySelector('.hl-badge')?.value?.trim() || val(`h_hl_${idx}_badge`),
            title: card.querySelector('.hl-title')?.value?.trim() || val(`h_hl_${idx}_title`),
            image: imgInput ? imgInput.value.trim() : (val(`h_hl_${idx}_img`) || 'assets/images/campus-main-entrance.jpg'),
            desc: card.querySelector('.hl-desc')?.value?.trim() || val(`h_hl_${idx}_desc`),
            link: card.querySelector('.hl-link')?.value?.trim() || val(`h_hl_${idx}_link`) || 'about-us'
          });
        });
      } else {
        for (let i = 0; i < 4; i++) {
          highlightsList.push({
            icon: defaultIcons[i] || 'star',
            tag: val(`h_hl_${i}_tag`),
            badge: val(`h_hl_${i}_badge`),
            title: val(`h_hl_${i}_title`),
            image: val(`h_hl_${i}_img`),
            desc: val(`h_hl_${i}_desc`),
            link: val(`h_hl_${i}_link`) || 'about-us'
          });
        }
      }

      payload = {
        pill_badge: val('h_pill_badge'),
        title_main: val('h_title_main'),
        title_highlight: val('h_title_highlight'),
        description: val('h_description'),
        cta_primary_text: val('h_cta_primary_text'),
        cta_primary_link: val('h_cta_primary_link'),
        cta_secondary_text: val('h_cta_secondary_text'),
        cta_secondary_link: val('h_cta_secondary_link'),
        hero_image: val('h_hero_image'),
        hero_video: val('h_hero_video'),
        video_mp4: val('h_hero_video'),
        hero_video_poster: val('h_video_poster'),
        announcement_text: val('h_announcement'),
        welcome: {
          subtitle: val('h_welcome_subtitle'),
          title: val('h_welcome_title'),
          description_1: val('h_welcome_desc_1'),
          description_2: val('h_welcome_desc_2'),
          image: val('h_welcome_image')
        },
        founder_quote: {
          quote: val('h_quote_text'),
          speaker_name: val('h_quote_speaker_name'),
          speaker_title: val('h_quote_speaker_title'),
          speaker_img: val('h_quote_speaker_img')
        },
        pillars: pillars,
        events_highlights: {
          subtitle: val('h_eh_subtitle') || 'Campus Life & Key Milestones',
          title: val('h_eh_title') || 'Upcoming Events & Institutional Highlights',
          description: val('h_eh_desc'),
          events_title: val('h_eh_events_title') || 'Upcoming Events',
          events_badge: val('h_eh_events_badge') || 'Academic Calendar 2026',
          highlights_title: val('h_eh_highlights_title') || 'College Highlights',
          highlights_badge: val('h_eh_highlights_badge') || 'Institutional Prestige',
          events: eventsList,
          highlights: highlightsList
        },
        vision: {
          title: val('h_vision_title'),
          description: val('h_vision_desc')
        },
        mission: {
          title: val('h_mission_title'),
          description: val('h_mission_desc')
        },
        course_spotlight: {
          badge: val('h_cs_badge'),
          subtitle: val('h_cs_subtitle'),
          title: val('h_cs_title'),
          description: val('h_cs_desc'),
          image: val('h_cs_image')
        },
        facilities: facilities,
        why_choose: whyChoose,
        placements: {
          heading: val('h_place_heading'),
          desc: val('h_place_desc'),
          placement_support: val('h_place_support'),
          companies_count: val('h_place_count'),
          highest_package: val('h_place_highest'),
          average_package: val('h_place_avg')
        },
        faqs: faqs,
        bottom_cta: {
          title: val('h_cta_title'),
          desc: val('h_cta_desc'),
          btn_text: val('h_cta_btn_text'),
          btn_link: val('h_cta_btn_link')
        }
      };
    } else if (pageKey === 'about_us') {
      const versatilityItems = [];
      for (let i = 0; i < 5; i++) {
        versatilityItems.push({
          title: val(`ab_vers_${i}_title`),
          text: val(`ab_vers_${i}_text`)
        });
      }

      const sisterLines = val('ab_sister_list').split('\n').map(s => s.trim()).filter(Boolean);

      payload = {
        banner: {
          title: val('ab_banner_title'),
          subtitle: val('ab_banner_subtitle'),
          badge: val('ab_banner_badge'),
          image: val('ab_banner_image')
        },
        welcome: {
          subtitle: val('ab_welcome_subtitle'),
          title: val('ab_welcome_title'),
          paragraph_1: val('ab_welcome_p1'),
          paragraph_2: val('ab_welcome_p2'),
          image: val('ab_welcome_img')
        },
        career_versatility: {
          cards: versatilityItems
        },
        versatility_items: versatilityItems,
        legacy: {
          title: val('ab_legacy_title'),
          description_1: val('ab_legacy_desc_1'),
          description_2: val('ab_legacy_desc_2'),
          image: val('ab_legacy_img')
        },
        genesis: {
          title: val('ab_legacy_title'),
          description_1: val('ab_legacy_desc_1'),
          description_2: val('ab_legacy_desc_2'),
          image: val('ab_legacy_img')
        },
        principal_address: {
          name: val('ab_princ_name'),
          designation: val('ab_princ_desig'),
          message: val('ab_princ_msg'),
          image: val('ab_princ_img')
        },
        vision: {
          title: val('ab_vision_title'),
          description: val('ab_vision_desc')
        },
        mission: {
          title: val('ab_mission_title'),
          description: val('ab_mission_desc')
        },
        sister_institutions: {
          title: val('ab_sister_title'),
          description: val('ab_sister_desc'),
          institutions: sisterLines
        },
        cta_banner: {
          title: val('ab_cta_title'),
          subtitle: val('ab_cta_desc'),
          btn_text: val('ab_cta_btn_text'),
          btn_link: val('ab_cta_btn_link')
        },
        bottom_cta: {
          title: val('ab_cta_title'),
          desc: val('ab_cta_desc'),
          btn_text: val('ab_cta_btn_text'),
          btn_link: val('ab_cta_btn_link')
        }
      };
    } else if (pageKey === 'leadership') {
      const leaders = [];
      for (let i = 0; i < 8; i++) {
        const rawBadges = val(`lead_ldr_${i}_badges`);
        const badgesArr = rawBadges ? rawBadges.split(',').map(b => b.trim()).filter(Boolean) : [];
        leaders.push({
          name: val(`lead_ldr_${i}_name`),
          tag: val(`lead_ldr_${i}_tag`),
          title: val(`lead_ldr_${i}_title`),
          image: val(`lead_ldr_${i}_img`),
          quote: val(`lead_ldr_${i}_quote`),
          badges: badgesArr
        });
      }

      const govCards = [];
      for (let c = 0; c < 3; c++) {
        govCards.push({
          title: val(`lead_gov_c_${c}_title`),
          desc: val(`lead_gov_c_${c}_desc`)
        });
      }

      payload = {
        banner: {
          title: val('lead_banner_title'),
          subtitle: val('lead_banner_subtitle'),
          badge: val('lead_banner_badge'),
          image: val('lead_banner_image')
        },
        section_header: {
          subtitle: val('lead_sec_subtitle'),
          title: val('lead_sec_title'),
          description: val('lead_sec_desc')
        },
        leaders: leaders,
        governance_philosophy: {
          subtitle: val('lead_gov_subtitle'),
          title: val('lead_gov_title'),
          description: val('lead_gov_desc'),
          cards: govCards
        },
        cta_banner: {
          title: val('lead_cta_title'),
          subtitle: val('lead_cta_sub'),
          btn1_text: val('lead_cta_b1_text'),
          btn1_link: val('lead_cta_b1_link'),
          btn2_text: val('lead_cta_b2_text'),
          btn2_link: val('lead_cta_b2_link')
        }
      };
    } else if (pageKey === 'courses') {
      const graduateAttributes = [];
      for (let i = 0; i < 10; i++) {
        const num = val(`crs_ga_${i}_num`) || String(i + 1).padStart(2, '0');
        graduateAttributes.push({
          num: num,
          title: val(`crs_ga_${i}_title`),
          desc: val(`crs_ga_${i}_desc`)
        });
      }

      const semesters = {};
      for (let s = 1; s <= 8; s++) {
        const semKey = `sem${s}`;
        const coursesList = [];
        let cIdx = 0;
        while (document.getElementById(`crs_s_${semKey}_c_${cIdx}_code`)) {
          coursesList.push({
            code: val(`crs_s_${semKey}_c_${cIdx}_code`),
            title: val(`crs_s_${semKey}_c_${cIdx}_title`),
            type: val(`crs_s_${semKey}_c_${cIdx}_type`),
            category: val(`crs_s_${semKey}_c_${cIdx}_cat`),
            hours: val(`crs_s_${semKey}_c_${cIdx}_hrs`),
            credits: val(`crs_s_${semKey}_c_${cIdx}_crd`)
          });
          cIdx++;
        }
        semesters[semKey] = {
          courses: coursesList
        };
      }

      payload = {
        banner: {
          title: val('c_crs_title'),
          subtitle: val('c_crs_subtitle'),
          badge: val('c_crs_badge'),
          image: val('c_crs_image')
        },
        highlights: {
          level: val('c_crs_level'),
          duration: val('c_crs_duration'),
          credits: val('c_crs_credits'),
          approval: val('c_crs_approval'),
          curriculum: val('c_crs_curriculum'),
          medium: val('c_crs_medium')
        },
        overview: {
          subtitle: val('c_ov_subtitle'),
          title: val('c_ov_title'),
          badge: val('c_ov_badge'),
          pill: val('c_ov_pill'),
          desc_p1: val('c_ov_desc_p1'),
          desc_p2: val('c_ov_desc_p2'),
          image: val('c_ov_image')
        },
        eligibility: {
          title: val('c_crs_el_title'),
          hsc_requirement: val('c_crs_hsc'),
          lateral_entry: val('c_crs_lateral')
        },
        cta_banner: {
          badge: val('c_cta_badge'),
          title: val('c_cta_title'),
          subtitle: val('c_cta_sub'),
          btn1_text: val('c_cta_b1_text'),
          btn1_link: val('c_cta_b1_link'),
          btn2_text: val('c_cta_b2_text'),
          btn2_link: val('c_cta_b2_link')
        },
        syllabus: {
          semesters: semesters,
          graduate_attributes: graduateAttributes,
          pharmacist_oath: {
            title: "The Pharmacist's Oath",
            badge: "PCI Code of Ethics",
            text: val('crs_ga_oath_text')
          }
        }
      };
    } else if (pageKey === 'facilities') {
      const amenities = [];
      for (let i = 0; i < 9; i++) {
        amenities.push({
          title: val(`fac_am_${i}_title`),
          desc: val(`fac_am_${i}_desc`),
          image: val(`fac_am_${i}_img`)
        });
      }

      const specializedLabs = [];
      for (let i = 0; i < 8; i++) {
        specializedLabs.push({
          title: val(`fac_lab_${i}_title`),
          image: val(`fac_lab_${i}_img`),
          description: val(`fac_lab_${i}_desc`)
        });
      }

      payload = {
        banner: {
          title: val('fac_banner_title'),
          subtitle: val('fac_banner_subtitle'),
          badge: val('fac_banner_badge'),
          image: val('fac_banner_image')
        },
        overview: {
          subtitle: val('fac_ov_subtitle'),
          title: val('fac_ov_title'),
          description_1: val('fac_ov_desc1'),
          description_2: val('fac_ov_desc2'),
          campus_front_img: val('fac_front_img'),
          lab_count: val('fac_lab_count'),
          hospital_info: val('fac_hospital_info')
        },
        amenities_header: {
          subtitle: val('fac_am_subtitle'),
          title: val('fac_am_title'),
          description: val('fac_am_desc')
        },
        amenities: amenities,
        specialized_labs: specializedLabs,
        placements: {
          badge: val('fac_pl_badge'),
          title: val('fac_pl_title'),
          description_1: val('fac_pl_desc1'),
          stat_1_val: val('fac_pl_s1_val'),
          stat_1_lbl: val('fac_pl_s1_lbl'),
          stat_2_val: val('fac_pl_s2_val'),
          stat_2_lbl: val('fac_pl_s2_lbl'),
          stat_3_val: val('fac_pl_s3_val'),
          stat_3_lbl: val('fac_pl_s3_lbl'),
          stat_4_val: val('fac_pl_s4_val'),
          stat_4_lbl: val('fac_pl_s4_lbl'),
          description_2: val('fac_pl_desc2'),
          btn_text: val('fac_pl_btn_text'),
          btn_link: val('fac_pl_btn_link')
        }
      };
    } else if (pageKey === 'highlights') {
      const catMap = {
        'pci': 'Statutory Accreditation',
        'curriculum': 'Curriculum Innovation',
        'infrastructure': 'Research Laboratories',
        'concluded': 'Concluded Event Highlight'
      };
      const items = [];
      const noticeCards = document.querySelectorAll('#highlightsItemsContainer .cms-hl-item-card');
      if (noticeCards.length > 0) {
        noticeCards.forEach((card, idx) => {
          const cat = card.querySelector('.hl-it-cat')?.value || val(`hl_it_${idx}_cat`) || 'pci';
          const itemId = card.querySelector('.hl-it-id')?.value || val(`hl_it_${idx}_id`) || `hl-${idx + 1}`;
          const itemSlug = card.querySelector('.hl-it-slug')?.value || val(`hl_it_${idx}_slug`) || itemId;
          const imgInput = card.querySelector('.cms-img-input') || card.querySelector('.hl-it-img') || document.getElementById(`hl_it_${idx}_img`);
          items.push({
            id: itemId,
            slug: itemSlug,
            category: cat,
            category_name: catMap[cat] || 'Official Circular',
            badge: card.querySelector('.hl-it-badge')?.value?.trim() || val(`hl_it_${idx}_badge`),
            circular_no: card.querySelector('.hl-it-ref')?.value?.trim() || val(`hl_it_${idx}_ref`),
            date: card.querySelector('.hl-it-date')?.value?.trim() || val(`hl_it_${idx}_date`),
            title: card.querySelector('.hl-it-title')?.value?.trim() || val(`hl_it_${idx}_title`),
            notice_image: imgInput ? imgInput.value.trim() : (val(`hl_it_${idx}_img`) || 'assets/images/campus-front.jpg'),
            summary: card.querySelector('.hl-it-summary')?.value?.trim() || val(`hl_it_${idx}_summary`),
            primary_btn_text: card.querySelector('.hl-it-btn-text')?.value?.trim() || val(`hl_it_${idx}_btn_text`) || 'View Details',
            primary_btn_link: card.querySelector('.hl-it-btn-link')?.value?.trim() || val(`hl_it_${idx}_btn_link`) || 'about-us'
          });
        });
      } else {
        let i = 0;
        while (document.getElementById(`hl_it_${i}_title`)) {
          const cat = val(`hl_it_${i}_cat`);
          const itemId = val(`hl_it_${i}_id`) || `hl-${i + 1}`;
          const itemSlug = val(`hl_it_${i}_slug`) || itemId;
          items.push({
            id: itemId,
            slug: itemSlug,
            category: cat,
            category_name: catMap[cat] || 'Official Circular',
            badge: val(`hl_it_${i}_badge`),
            circular_no: val(`hl_it_${i}_ref`),
            date: val(`hl_it_${i}_date`),
            title: val(`hl_it_${i}_title`),
            notice_image: val(`hl_it_${i}_img`),
            summary: val(`hl_it_${i}_summary`),
            primary_btn_text: val(`hl_it_${i}_btn_text`),
            primary_btn_link: val(`hl_it_${i}_btn_link`)
          });
          i++;
        }
      }

      payload = {
        banner: {
          title: val('hl_banner_title'),
          subtitle: val('hl_banner_sub'),
          image: val('hl_banner_img')
        },
        intro: {
          title: val('hl_intro_title'),
          subtitle: val('hl_intro_sub')
        },
        items: items
      };
    } else if (pageKey === 'faculties_page') {
      payload = {
        banner: {
          title: val('facp_banner_title'),
          subtitle: val('facp_banner_subtitle'),
          badge: val('facp_banner_badge'),
          image: val('facp_banner_image')
        },
        intro: {
          title: val('facp_intro_title'),
          description: val('facp_intro_desc')
        }
      };
    } else if (pageKey === 'anti_ragging') {
      const statutoryCells = [];
      for (let i = 0; i < 3; i++) {
        statutoryCells.push({
          badge: val(`ar_cell_${i}_badge`),
          title: val(`ar_cell_${i}_title`),
          desc: val(`ar_cell_${i}_desc`),
          pdf_link: val(`ar_cell_${i}_link`)
        });
      }

      payload = {
        banner: {
          title: val('ar_banner_title'),
          subtitle: val('ar_banner_subtitle'),
          badge: val('ar_banner_badge'),
          image: val('ar_banner_image')
        },
        helplines: {
          national_toll_free: val('ar_tollfree'),
          national_portal: val('ar_portal'),
          campus_cell_phone: val('ar_campus_cell'),
          campus_cell_email: val('ar_email')
        },
        policy_statement: {
          title: val('ar_pol_title'),
          quote: val('ar_pol_quote'),
          paragraph_1: val('ar_pol_p1'),
          consequences: val('ar_pol_consequences')
        },
        statutory_protection_cells: statutoryCells
      };
    } else if (pageKey === 'contact_us') {
      const commuteModes = [];
      for (let i = 0; i < 3; i++) {
        commuteModes.push({
          title: val(`ct_com_${i}_title`),
          desc: val(`ct_com_${i}_desc`),
          chip: val(`ct_com_${i}_chip`)
        });
      }

      payload = {
        banner: {
          title: val('ct_banner_title'),
          subtitle: val('ct_banner_subtitle'),
          badge: val('ct_banner_badge'),
          image: val('ct_banner_image')
        },
        cards: {
          campus_address: {
            title: val('ct_card_loc_title'),
            address: val('ct_card_loc_addr')
          },
          phone_lines: {
            number: val('ct_card_phone_num'),
            hours: val('ct_card_phone_hrs')
          },
          email_desks: {
            email: val('ct_card_email_val')
          },
          campus_hours: {
            weekdays: val('ct_card_hrs_wd'),
            saturdays: val('ct_card_hrs_sat')
          }
        },
        location_map: {
          embed_url: val('ct_map_url'),
          gps_coordinates: val('ct_map_gps'),
          directions_url: val('ct_map_dir')
        },
        commute_modes: commuteModes
      };
    } else if (pageKey === 'enquiry') {
      const whyApply = [];
      for (let i = 0; i < 4; i++) {
        whyApply.push({
          title: val(`enq_why_${i}_title`),
          desc: val(`enq_why_${i}_desc`)
        });
      }

      payload = {
        banner: {
          title: val('enq_banner_title'),
          subtitle: val('enq_banner_subtitle'),
          badge: val('enq_banner_badge'),
          image: val('enq_banner_image')
        },
        intro: {
          badge: val('enq_intro_badge'),
          title: val('enq_intro_title'),
          desc: val('enq_intro_desc')
        },
        helpdesk: {
          counseling_phone: val('enq_help_phone'),
          counseling_email: val('enq_help_email'),
          counseling_hours: val('enq_help_hours')
        },
        why_apply: {
          title: val('enq_why_title'),
          points: whyApply
        }
      };
    }

    const fd = new FormData();
    fd.append('action', 'save_content');
    fd.append('page', pageKey);
    fd.append('content', JSON.stringify(payload));
    fd.append('csrf_token', csrfToken);

    showToast('Saving ' + pageKey.replace('_', ' ') + ' changes...', 'info');

    fetch('/cms/api.php', { method: 'POST', body: fd })
      .then(r => r.json())
      .then(res => {
        if (res.success) {
          showToast(res.message, 'success');
        } else {
          showToast(res.message, 'danger');
        }
      })
      .catch(() => showToast('Failed to save page content.', 'danger'));
  };


  // -------------------------------------------------------------
  // 6. DEDICATED SEO / GEO / AEO & TRAFFIC HUB
  // -------------------------------------------------------------
  // Mode switcher (Engine Settings vs Search Traffic)
  const seoModeBtns = document.querySelectorAll('.seo-mode-btn');
  const seoEnginePane = document.getElementById('seoEnginePane');
  const seoTrafficPane = document.getElementById('seoTrafficPane');

  seoModeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      seoModeBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const mode = btn.getAttribute('data-seomode');

      if (mode === 'config') {
        if (seoEnginePane) seoEnginePane.style.display = 'block';
        if (seoTrafficPane) seoTrafficPane.style.display = 'none';
      } else {
        if (seoEnginePane) seoEnginePane.style.display = 'none';
        if (seoTrafficPane) seoTrafficPane.style.display = 'block';
      }
    });
  });

  // SEO Page Tab Switcher inside Engine Settings
  const seoPageTabBtns = document.querySelectorAll('.seo-page-tab-btn');
  const fullSeoStoreEl = document.getElementById('fullSeoDataStore');
  let fullSeoData = {};
  try {
    fullSeoData = JSON.parse(fullSeoStoreEl?.value || '{}');
  } catch (err) {
    fullSeoData = {};
  }

  seoPageTabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Save currently active page inputs into fullSeoData first
      const curKey = document.getElementById('currentSeoPageKey')?.value || 'home';
      if (fullSeoData.pages && fullSeoData.pages[curKey]) {
        fullSeoData.pages[curKey].title = document.getElementById('seoInputTitle')?.value || '';
        fullSeoData.pages[curKey].description = document.getElementById('seoInputDesc')?.value || '';
        fullSeoData.pages[curKey].keywords = document.getElementById('seoInputKeywords')?.value || '';
        fullSeoData.pages[curKey].canonical = document.getElementById('seoInputCanonical')?.value || '';
        fullSeoData.pages[curKey].og_image = document.getElementById('seoInputOgImage')?.value || '';
      }

      // Switch active button
      seoPageTabBtns.forEach(b => {
        b.classList.remove('cms-btn-primary');
        b.classList.add('cms-btn-secondary');
      });
      btn.classList.remove('cms-btn-secondary');
      btn.classList.add('cms-btn-primary');

      const nextKey = btn.getAttribute('data-page-key');
      document.getElementById('currentSeoPageKey').value = nextKey;
      const headingEl = document.getElementById('seoMetaEditorHeading');
      if (headingEl) {
        headingEl.textContent = 'Page Meta Tags & Canonical URLs (' + (btn.textContent.trim()) + ')';
      }

      // Populate inputs with nextKey data
      const nextData = fullSeoData.pages?.[nextKey] || {};
      document.getElementById('seoInputTitle').value = nextData.title || '';
      document.getElementById('seoInputDesc').value = nextData.description || '';
      document.getElementById('seoInputKeywords').value = nextData.keywords || '';
      document.getElementById('seoInputCanonical').value = nextData.canonical || '';
      document.getElementById('seoInputOgImage').value = nextData.og_image || 'assets/images/campus-front.jpg';
    });
  });

  // Save SEO, GEO & AEO button
  const saveSeoBtn = document.getElementById('saveSeoBtn');
  if (saveSeoBtn) {
    saveSeoBtn.addEventListener('click', () => {
      // 1. Commit current active page inputs
      const curKey = document.getElementById('currentSeoPageKey')?.value || 'home';
      if (fullSeoData.pages && fullSeoData.pages[curKey]) {
        fullSeoData.pages[curKey].title = document.getElementById('seoInputTitle')?.value || '';
        fullSeoData.pages[curKey].description = document.getElementById('seoInputDesc')?.value || '';
        fullSeoData.pages[curKey].keywords = document.getElementById('seoInputKeywords')?.value || '';
        fullSeoData.pages[curKey].canonical = document.getElementById('seoInputCanonical')?.value || '';
        fullSeoData.pages[curKey].og_image = document.getElementById('seoInputOgImage')?.value || '';
      }

      // 2. Commit AI crawlers
      document.querySelectorAll('.ai-bot-toggle').forEach(chk => {
        const botName = chk.getAttribute('data-bot');
        if (fullSeoData.geo_engine?.ai_crawler_permissions) {
          fullSeoData.geo_engine.ai_crawler_permissions[botName] = chk.checked;
        }
      });

      // 3. Commit Knowledge Graph
      if (fullSeoData.geo_engine?.knowledge_graph_entity) {
        const kg = fullSeoData.geo_engine.knowledge_graph_entity;
        kg.legal_name = document.getElementById('kg_legal_name')?.value || kg.legal_name;
        kg.brand_name = document.getElementById('kg_brand_name')?.value || kg.brand_name;
        kg.parent_organization = document.getElementById('kg_parent_org')?.value || kg.parent_organization;
        kg.accreditation = document.getElementById('kg_accreditation')?.value || kg.accreditation;
        kg.founder_chancellor = document.getElementById('kg_chancellor')?.value || kg.founder_chancellor;
        kg.principal = document.getElementById('kg_principal')?.value || kg.principal;
      }

      // 4. Commit AEO voice direct answers
      document.querySelectorAll('.aeo-answer-input').forEach(inp => {
        const qid = inp.getAttribute('data-qna-id');
        const item = (fullSeoData.aeo_engine?.featured_qna_snippets || []).find(q => q.id === qid);
        if (item) item.direct_answer = inp.value;
      });

      const fd = new FormData();
      fd.append('action', 'save_seo');
      fd.append('seo_data', JSON.stringify(fullSeoData));
      fd.append('csrf_token', csrfToken);

      showToast('Publishing SEO, GEO & AEO configurations...', 'info');

      fetch('/cms/api.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            showToast(res.message, 'success');
          } else {
            showToast(res.message, 'danger');
          }
        })
        .catch(() => showToast('Failed to publish SEO updates.', 'danger'));
    });
  }

  // -------------------------------------------------------------
  // 7. SECURITY & MASTER PASSWORD UPDATE
  // -------------------------------------------------------------
  const changePasswordForm = document.getElementById('changePasswordForm');
  if (changePasswordForm) {
    changePasswordForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const cur = document.getElementById('currentPasswordInput')?.value || '';
      const np = document.getElementById('newPasswordInput')?.value || '';
      const cp = document.getElementById('confirmPasswordInput')?.value || '';

      if (np !== cp) {
        showToast('New passwords do not match.', 'danger');
        return;
      }

      const fd = new FormData();
      fd.append('action', 'change_password');
      fd.append('current_password', cur);
      fd.append('new_password', np);
      fd.append('csrf_token', csrfToken);

      fetch('/cms/api.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            changePasswordForm.reset();
            showToast(res.message, 'success');
          } else {
            showToast(res.message, 'danger');
          }
        })
        .catch(() => showToast('Error updating password.', 'danger'));
    });
  }

});
