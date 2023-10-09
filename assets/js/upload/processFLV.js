document.addEventListener('DOMContentLoaded', () => {
    const { createWorker } = FFmpeg;
    const worker = createWorker({
        logger: m => console.log(m)
    });

    const inputFile = document.getElementById('file-input');
    const processButton = document.getElementById('process-button');
    const downloadLinkFLV = document.getElementById('download-link-flv');

    processButton.addEventListener('click', async () => {
        const file = inputFile.files[0];

        if (!file) {
            alert('Please select a file.');
            return;
        }

        const randomID = generateRandomFileName(12);

        const inputFileName = `${randomID}.mp4`;
        const outputFileNameFLV = `${randomID}.flv`;

        await worker.load();
        await worker.write(inputFileName, file);
        console.log('Write complete');

        await worker.run(`-i ${inputFileName} -c:v flv -b:v 10k -an -f flv ${outputFileNameFLV}`);
        console.log('FLV processing finished');

        const { data: flvData } = await worker.read(outputFileNameFLV);

        const flvBlob = new Blob([flvData], { type: 'video/x-flv' });

        downloadLinkFLV.href = URL.createObjectURL(flvBlob);
        downloadLinkFLV.download = `${randomID}.flv`;
        downloadLinkFLV.innerHTML = 'Download FLV';

        const formDataFLV = new FormData();
        formDataFLV.append('flv_video', flvBlob, `${randomID}.flv`);
        worker.terminate();
        fetch('http://localhost:8080/backend/upload.php', {
            method: 'POST',
            body: formDataFLV, 
        }).then(responseFLV => {
            if (responseFLV.ok) {
                console.log('Processed FLV video sent to the server successfully.');
            } else {
                console.error('Error sending processed FLV video to the server.');
            }
        });
    });

    function generateRandomFileName(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

});