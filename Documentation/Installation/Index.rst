.. include:: ../Includes.txt

.. _installation:

============
Installation
============

Just install this extension the usual way like any other TYPO3 extension.

.. rst-class:: bignums-xxl

#. Get the extension

   In the TYPO3 backend you can use the extension manager (EM).

   .. rst-class:: bignums

   #. Switch to the module “Extension Manager”.

   #. Get the extension

   #. **Get it from the Extension Manager:**
      Press the “Retrieve/Update” button and search for the extension key
      *ns_sharethis* and import the extension from the repository.

   #. **Get it from typo3.org:** You can always get the current version from
      https://extensions.typo3.org/extension/ns_sharethis/ by downloading either
      the t3x or zip version. Upload the file afterwards in the Extension Manager.

   .. figure:: Images/TYPO3-EXTns_sharethis-Install_1.png
       :alt: installation with the extension manager in the backend
       :width: 1100px


#. Activate the TypoScript

   The extension ships some static TypoScript code which needs to be included.

   .. rst-class:: bignums

   #. Switch to the root page of your site.

   #. Switch to the **Template module** and select *Info/Modify*.

   #. Click the link **Edit the whole template record** and switch to the tab
      *Includes*.

   #. Select **[NITSAN] ns_sharethis** at the field *Include static
      (from extensions):*

   #. Include **[NITSAN] ns_sharethis** at the last place.

   .. figure:: Images/TYPO3-EXTns_sharethis-Install_2.png
       :alt: installation
       :width: 1100px

